<?php

namespace App\Filament\Resources\Features\Pages;

use App\Filament\Resources\Features\FeatureResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListFeatures extends ListRecords
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import')
                ->label('Import')
                ->icon(Heroicon::ArrowDownTray)
                ->modalContent(view('filament.actions.clickup-tasks-modal'))
                ->modalSubmitAction(false)
                ->modalWidth('7xl'),
        ];
    }
}
