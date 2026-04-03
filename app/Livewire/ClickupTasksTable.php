<?php

namespace App\Livewire;

use App\Enums\Feature\FeatureStatus;
use App\Enums\Feature\FeatureType;
use App\Models\Feature;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ClickupTasksTable extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->searchable(false)
            ->columnManager(false)
            ->records(fn (): array => $this->fetchTasks())
            ->columns([
                TextColumn::make('name')
                    ->sortable(false),
                TextColumn::make('status')
                    ->sortable(false),
                TextColumn::make('type')
                    ->sortable(false),
                TextColumn::make('effort_in_days')
                    ->label('Effort (days)')
                    ->sortable(false),
                TextColumn::make('priority')
                    ->sortable(false),
                TextColumn::make('cost')
                    ->money()
                    ->sortable(false),
                TextColumn::make('target_delivery_date')
                    ->date()
                    ->sortable(false),
            ])
            ->recordActions([
                Action::make('import')
                    ->label('Import')
                    ->icon(Heroicon::ArrowDownTray)
                    ->fillForm(fn (array $record): array => $record)
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Textarea::make('description')
                            ->required(),
                        Select::make('status')
                            ->options(FeatureStatus::class)
                            ->required(),
                        Select::make('type')
                            ->options(FeatureType::class)
                            ->required(),
                        TextInput::make('effort_in_days')
                            ->label('Effort (days)')
                            ->numeric()
                            ->required(),
                        TextInput::make('priority')
                            ->numeric()
                            ->required(),
                        TextInput::make('cost')
                            ->numeric()
                            ->required(),
                        DatePicker::make('target_delivery_date'),
                    ])
                    ->action(function (array $data): void {
                        Feature::create($data);

                        Notification::make()
                            ->title('Feature imported successfully')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    /** @return array<int, array<string, mixed>> */
    protected function fetchTasks(): array
    {
        return collect(Http::get(route('api.tasks'))->json())
            ->keyBy('id')
            ->all();
    }

    public function render(): View
    {
        return view('livewire.clickup-tasks-table');
    }
}
