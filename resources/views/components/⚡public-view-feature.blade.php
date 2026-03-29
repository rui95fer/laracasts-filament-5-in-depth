<?php

use App\Models\Feature;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component implements HasActions, HasSchemas {

    use InteractsWithActions;
    use InteractsWithSchemas;

    public Feature $feature;

    public ?array $data = [];

    public function mount(): void
    {
        $this->refreshFeature();
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('body')
                    ->label('')
                    ->placeholder('Add a comment...')
                    ->rows(3)
                    ->required(),
            ])
            ->statePath('data');
    }

    public function refreshFeature(): void
    {
        $this->feature = Feature::withCount(['votes', 'comments'])
            ->withExists(['votes as hasVoted' => fn($q) => $q->where('user_id', auth()->id())])
            ->findOrFail($this->feature->id);
    }

    public function vote(): void
    {
        if ($this->feature->votes()->where('user_id', auth()->id())->exists()) {
            $this->feature->votes()->where('user_id', auth()->id())->delete();
            $this->feature->hasVoted = false;
        } else {
            $this->feature->votes()->create(['user_id' => auth()->id()]);
            $this->feature->hasVoted = true;
        }

        $this->refreshFeature();
    }

    public function postComment(): void
    {
        $data = $this->form->getState();

        $this->feature->comments()->create([
            'body' => $data['body'],
            'user_id' => auth()->id(),
        ]);

        $this->form->fill();
        $this->refreshFeature();
        unset($this->comments);

        Notification::make()
            ->title('Comment posted')
            ->success()
            ->send();
    }

    #[Computed]
    public function comments()
    {
        return $this->feature->comments()->with('user')->latest()->get();
    }
};
?>

<x-feature-view-layout :feature="$feature">
    <form wire:submit="postComment" class="mb-8">
        {{ $this->form }}

        <div class="flex justify-end mt-3">
            <button type="submit"
                    class="px-5 py-2 text-sm font-medium text-white transition-all rounded-lg bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                Post Comment
            </button>
        </div>
    </form>

    <x-filament-actions::modals/>
</x-feature-view-layout>
