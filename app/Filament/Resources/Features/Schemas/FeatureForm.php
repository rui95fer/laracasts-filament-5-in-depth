<?php

namespace App\Filament\Resources\Features\Schemas;

use App\Enums\Feature\FeatureStatus;
use App\Enums\Feature\FeatureType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Slider;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class FeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Overview')
                    ->description('General information about the feature.')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Feature name'),
                        Select::make('status')
                            ->options(FeatureStatus::class)
                            ->enum(FeatureStatus::class)
                            ->searchable()
                            ->required()
                            ->live()
                            ->default(FeatureStatus::Proposed),
                        ToggleButtons::make('type')
                            ->options(FeatureType::class)
                            ->enum(FeatureType::class)
                            ->inline()
                            ->required()
                            ->default(FeatureType::Feature)
                            ->hiddenLabel()
                            ->extraFieldWrapperAttributes([
                                'class' => 'pt-7',
                            ]),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->extraInputAttributes([
                                'class' => 'min-h-[200px]',
                            ]),
                        Slider::make('priority')
                            ->range(minValue: 1, maxValue: 10)
                            ->step(1)
                            ->default(5)
                            ->fillTrack()
                            ->pips()
                            ->tooltips()
                            ->required()
                            ->rule('integer')
                            ->columnSpanFull(),
                    ]),
                Section::make('Effort & Cost')
                    ->description('Estimate the effort required and the associated cost.')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextInput::make('effort_in_days')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->suffix('days')
                            ->afterStateUpdatedJs(<<<'JS'
                                $set('cost', Number($state ?? 0) * ($get('is_high_cost') ? 1500 : 1000))
                                JS
                            ),

                        TextInput::make('cost')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('$'),
                        Toggle::make('is_high_cost')
                            ->label('High cost')
                            ->default(false)
                            ->dehydrated(false)
                            ->inline(false)
                            ->afterStateUpdatedJs(<<<'JS'
                                $set('cost', Number($get('effort_in_days') ?? 0) * ($state ? 1500 : 1000))
                                JS
                            ),
                    ]),
                Section::make('Scheduling')
                    ->description('Set the target delivery and completion dates.')
                    ->columnSpanFull()
                    ->columns()
                    ->visibleJs(<<<'JS'
                        ['Planned', 'In Progress', 'Completed'].includes($get('status'))
                        JS
                    )
                    ->schema([
                        DatePicker::make('target_delivery_date')
                            ->visibleJs(<<<'JS'
                                ['Planned', 'In Progress'].includes($get('status'))
                                JS
                            )
                            ->required(fn(Get $get): bool => in_array($get('status'), [FeatureStatus::Planned, FeatureStatus::InProgress], true)),
                        DateTimePicker::make('delivered_at')
                            ->visibleJs(<<<'JS'
                                ['Completed'].includes($get('status'))
                                JS
                            )
                            ->required(fn(Get $get): bool => $get('status') === FeatureStatus::Completed),
                    ]),
                Section::make('Milestones')
                    ->description('Track key milestones for this feature.')
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('milestones')
                            ->relationship()
                            ->table([
                                TableColumn::make('Title')->markAsRequired(),
                                TableColumn::make('Due Date')->markAsRequired(),
                                TableColumn::make('Completed'),
                            ])
                            ->schema([
                                TextInput::make('title')
                                    ->required(),
                                DatePicker::make('due_date')
                                    ->required(),
                                Toggle::make('is_completed')
                                    ->default(false),
                            ])
                            ->minItems(1)
                            ->maxItems(10)
                            ->compact(),
                    ]),
            ]);
    }
}
