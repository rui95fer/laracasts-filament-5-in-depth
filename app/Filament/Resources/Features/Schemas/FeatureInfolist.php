<?php

namespace App\Filament\Resources\Features\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FeatureInfolist
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
                        TextEntry::make('name')
                            ->icon('heroicon-m-tag'),
                        TextEntry::make('type')
                            ->badge(),
                        TextEntry::make('status')
                            ->badge(),
                        TextEntry::make('description')
                            ->html()
                            ->columnSpanFull(),
                        TextEntry::make('priority')
                            ->numeric()
                            ->suffix(' / 10')
                            ->icon('heroicon-m-chart-bar')
                            ->columnSpanFull(),
                    ]),

                Section::make('Effort & Cost')
                    ->description('Estimated effort and associated cost.')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('effort_in_days')
                            ->numeric()
                            ->suffix(' days')
                            ->icon('heroicon-m-clock'),
                        TextEntry::make('cost')
                            ->money()
                            ->icon('heroicon-m-currency-dollar'),
                    ]),

                Section::make('Scheduling')
                    ->description('Target delivery and completion dates.')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('target_delivery_date')
                            ->date()
                            ->placeholder('-')
                            ->icon('heroicon-m-calendar-days'),
                        TextEntry::make('delivered_at')
                            ->dateTime()
                            ->placeholder('-')
                            ->icon('heroicon-m-check-circle'),
                    ]),

                Section::make('Milestones')
                    ->description('Key milestones for this feature.')
                    ->columnSpanFull()
                    ->schema([
                        RepeatableEntry::make('milestones')
                            ->table([
                                TableColumn::make('Title'),
                                TableColumn::make('Due Date'),
                                TableColumn::make('Completed'),
                            ])
                            ->schema([
                                TextEntry::make('title'),
                                TextEntry::make('due_date')
                                    ->date(),
                                IconEntry::make('is_completed')
                                    ->boolean(),
                            ]),
                    ]),
            ]);
    }
}
