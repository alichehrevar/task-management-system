<?php

namespace App\Trait;

use App\Events\TaskCreated;
use App\Jobs\ProcessHighPriorityTask;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

trait TaskTrait
{
    /**
     * @return Collection
     */
    public function tasksList(): Collection
    {
        return Task::query()->orderBy('due_date', 'asc')->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function storeTask($data): mixed
    {
        try {
            $task = Task::query()->create($data);

            if ($data['priority'] === 'high') {
                ProcessHighPriorityTask::dispatch($task);
            }
            TaskCreated::dispatch($task);
            return config('global.successStatus');
        } catch (\Exception $exception) {
            return config('global.serverErrorStatus');
        }
    }

    /**
     * @param Task $task
     * @param $data
     * @return mixed
     */
    public function updateTask(Task $task, $data): mixed
    {
        return $task->update($data)
            ? config('global.successStatus')
            : config('global.serverErrorStatus');
    }

    /**
     * @param Task $task
     * @return mixed
     */
    public function deleteTask(Task $task): mixed
    {
        return $task->delete()
            ? config('global.successStatus')
            : config('global.serverErrorStatus');
    }
}
