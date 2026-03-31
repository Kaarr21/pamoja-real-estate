<?php

namespace App\Filament\Resources\WebsiteSettings;

use App\Filament\Resources\WebsiteSettings\Pages;
use App\Models\WebsiteSetting;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WebsiteSettingResource extends Resource
{
    protected static ?string $model = WebsiteSetting::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Branding')
                    ->schema([
                        TextInput::make('site_name')->required(),
                        TextInput::make('logo_text')->required(),
                    ])->columns(2),

                Section::make('Hero Content')
                    ->schema([
                        TextInput::make('hero_title')->required(),
                        Textarea::make('hero_subtitle'),
                        TextInput::make('hero_cta_primary')->required(),
                        TextInput::make('hero_cta_secondary')->required(),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('contact_email')->email()->required(),
                        TextInput::make('contact_phone')->required(),
                        Textarea::make('contact_address'),
                    ])->columns(2),

                Section::make('Social Presence')
                    ->schema([
                        TextInput::make('facebook_url')->url(),
                        TextInput::make('instagram_url')->url(),
                        TextInput::make('linkedin_url')->url(),
                        TextInput::make('twitter_url')->url(),
                    ])->columns(2),

                Section::make('Footer & SEO')
                    ->schema([
                        TextInput::make('footer_copy')->required(),
                        Textarea::make('meta_description'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name'),
                TextColumn::make('contact_email'),
                TextColumn::make('contact_phone'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function canCreate(): bool
    {
        return WebsiteSetting::count() === 0;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWebsiteSettings::route('/'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }
}
