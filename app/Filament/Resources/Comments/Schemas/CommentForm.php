<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Comment')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('feature_id')
                            ->label('Feature')
                            ->relationship('feature', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Textarea::make('body')
                            ->label('Comment')
                            ->required()
                            ->columnSpanFull()
                            ->rows(4),
                        Toggle::make('is_approved')
                            ->label('Approved')
                            ->default(false),
                    ]),
            ]);
    }
}
