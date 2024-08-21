<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Http\Requests\TaskRequest;
use App\Jobs\ProcessHighPriorityTask;
use App\Models\Task;
use App\Trait\TaskTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    use TaskTrait;

    /**
     * Display a listing of the tasks.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('tasks.index', ['tasks' => $this->tasksList()]);
    }

    /**
     * Show the form for creating a new task.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        return $this->storeTask($request->toArray()) == config('global.successStatus')
            ? redirect()->route('tasks.index')->with('success', 'Task created successfully.')
            : redirect()->route('tasks.index')->with('error', 'Error creating task');
    }

    /**
     * Display the specified task.
     *
     * @param Task $task
     * @return Application|Factory|View
     */
    public function show(Task $task): View|Factory|Application
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param Task $task
     * @return Factory|View|Application
     */
    public function edit(Task $task): Application|View|Factory
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param TaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        return $this->updateTask($task, $request->toArray()) == config('global.successStatus')
            ? redirect()->route('tasks.index')->with('success', 'Task updated successfully.')
            : redirect()->route('tasks.index')->with('error', 'Error updating task');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        return $this->deleteTask($task) == config('global.successStatus')
            ? redirect()->route('tasks.index')->with('success', 'Task deleted successfully.')
            : redirect()->route('tasks.index')->with('error', 'Error deleting task');
    }
}
