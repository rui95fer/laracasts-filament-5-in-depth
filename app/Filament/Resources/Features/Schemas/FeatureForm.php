<?php

namespace App\Filament\Resources\Features\Schemas;

use App\Enums\Feature\FeatureStatus;
use App\Enums\Feature\FeatureType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Slider;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class FeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('status')
                    ->options(FeatureStatus::class)
                    ->enum(FeatureStatus::class)
                    ->searchable()
                    ->required()
                    ->default(FeatureStatus::Proposed),
                ToggleButtons::make('type')
                    ->options(FeatureType::class)
                    ->enum(FeatureType::class)
                    ->inline()
                    ->required()
                    ->default(FeatureType::Feature)
                    ->hiddenLabel(),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('effort_in_days')
                    ->required()
                    ->numeric()
                    ->default(0),
                Slider::make('priority')
                    ->range(minValue: 1, maxValue: 10)
                    ->step(1)
                    ->default(5)
                    ->fillTrack()
                    ->pips()
                    ->tooltips()
                    ->required()
                    ->rule('integer'),
                TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                DatePicker::make('target_delivery_date'),
                DateTimePicker::make('delivered_at'),
            ]);
    }
}
