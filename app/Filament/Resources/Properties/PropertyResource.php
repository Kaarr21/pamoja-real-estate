<?php

namespace App\Filament\Resources\Properties;

use App\Enums\PropertyStatus;
use App\Filament\Resources\Properties\Pages\CreateProperty;
use App\Filament\Resources\Properties\Pages\EditProperty;
use App\Filament\Resources\Properties\Pages\ListProperties;
use App\Models\Property;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, \Filament\Schemas\Components\Component $component) => 
                        $operation === 'create' ? $component->getContainer()->getComponent('slug')?->state(\Illuminate\Support\Str::slug($state)) : null
                    )
                    ->maxLength(255),
                
                TextInput::make('slug')
                    ->required()
                    ->unique(Property::class, 'slug', ignoreRecord: true)
                    ->disabled(fn (string $operation) => $operation === 'edit')
                    ->maxLength(255),

                RichEditor::make('description')
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('KES'),

                Select::make('status')
                    ->required()
                    ->options(PropertyStatus::class)
                    ->default(PropertyStatus::FOR_SALE)
                    ->native(false),

                TextInput::make('location')
                    ->nullable()
                    ->maxLength(255),

                Select::make('agent_id')
                    ->relationship('agent', 'name')
                    ->required()
                    ->searchable()
                    ->default(auth()->id())
                    ->disabled(fn () => ! auth()->user()->hasRole('admin'))
                    ->dehydrated(),

                SpatieMediaLibraryFileUpload::make('images')
                    ->collection('images')
                    ->multiple()
                    ->image()
                    ->maxSize(10240) // 10MB
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('videos')
                    ->collection('videos')
                    ->multiple()
                    ->acceptedFileTypes(['video/mp4', 'video/quicktime'])
                    ->maxSize(20480) // 20MB
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('images')
                    ->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->money('KES')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('location')
                    ->searchable(),

                TextColumn::make('agent.name')
                    ->sortable()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(PropertyStatus::class),
                SelectFilter::make('agent_id')
                    ->label('Agent')
                    ->relationship('agent', 'name')
                    ->searchable()
                    ->preload()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
                Filter::make('price')
                    ->form([
                        TextInput::make('price_from')->numeric()->label('Price From'),
                        TextInput::make('price_to')->numeric()->label('Price To'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['price_from'], fn ($q) => $q->where('price', '>=', $data['price_from']))
                            ->when($data['price_to'], fn ($q) => $q->where('price', '<=', $data['price_to']));
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->hasRole('admin')) {
            return $query;
        }

        return $query->where('agent_id', auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProperties::route('/'),
            'create' => CreateProperty::route('/create'),
            'edit' => EditProperty::route('/{record}/edit'),
        ];
    }
}
