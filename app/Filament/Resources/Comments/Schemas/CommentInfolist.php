<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Comment')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->icon('heroicon-m-user'),
                        TextEntry::make('feature.name')
                            ->icon('heroicon-m-rectangle-stack'),
                        TextEntry::make('body')
                            ->columnSpanFull(),
                        IconEntry::make('is_approved')
                            ->label('Approved')
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->icon('heroicon-m-calendar'),
                    ]),
            ]);
    }
}
