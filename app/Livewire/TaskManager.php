<?php

namespace App\Livewire;

use App\Models\Task;
use App\Trait\TaskTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class TaskManager extends Component
{
    use TaskTrait;

    public $tasks;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->tasks = $this->tasksList();
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('livewire.task-manager');
    }
}
