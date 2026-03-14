<?php

namespace App\Enums\Feature;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum FeatureType: string implements HasColor, HasIcon, HasLabel
{
    case Feature = 'Feature';
    case Bug = 'Bug';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Feature => 'success',
            self::Bug => 'danger',
        };
    }

    public function getIcon(): string|BackedEnum|Htmlable|null
    {
        return match ($this) {
            self::Feature => 'heroicon-m-sparkles',
            self::Bug => 'heroicon-m-bug-ant',
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return $this->value;
    }
}
