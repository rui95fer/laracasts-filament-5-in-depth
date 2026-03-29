<?php

namespace App\Filament\Resources\Votes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VoteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Vote')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('User')
                            ->icon('heroicon-m-user'),
                        TextEntry::make('feature.name')
                            ->label('Feature')
                            ->icon('heroicon-m-rectangle-stack'),
                        TextEntry::make('created_at')
                            ->label('Voted At')
                            ->dateTime()
                            ->icon('heroicon-m-calendar'),
                    ]),
            ]);
    }
}
