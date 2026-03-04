<?php

namespace App\Enums\Feature;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum FeatureStatus: string implements HasColor, HasIcon, HasLabel
{
    case Proposed = 'Proposed';
    case Planned = 'Planned';
    case InProgress = 'In Progress';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Proposed => 'gray',
            self::Planned => 'info',
            self::InProgress => 'warning',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function getIcon(): string|BackedEnum|Htmlable|null
    {
        return match ($this) {
            self::Proposed => 'heroicon-m-light-bulb',
            self::Planned => 'heroicon-m-calendar-days',
            self::InProgress => 'heroicon-m-arrow-path',
            self::Completed => 'heroicon-m-check-circle',
            self::Cancelled => 'heroicon-m-x-circle',
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return $this->value;
    }
}
