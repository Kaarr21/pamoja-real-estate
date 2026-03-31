<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PropertyStatus: string implements HasLabel, HasColor
{
    case FOR_SALE = 'for_sale';
    case SOLD = 'sold';
    case RENTED = 'rented';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FOR_SALE => 'For Sale',
            self::SOLD => 'Sold',
            self::RENTED => 'Rented',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::FOR_SALE => 'success',
            self::SOLD => 'danger',
            self::RENTED => 'warning',
        };
    }
}
