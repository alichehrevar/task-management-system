<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Trait\TaskTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class TaskController extends Controller
{
    use TaskTrait;

    /**
     * @return mixed
     */
    public function index(): mixed
    {
        return response()->api($this->tasksList(), '', config('global.successStatus'));
    }

    /**
     * @param TaskRequest $request
     * @return mixed
     */
    public function store(TaskRequest $request): mixed
    {
        return $this->storeTask($request->toArray()) == config('global.successStatus')
            ? response()->api('Task created successfully', 'Task created successfully', config('global.successStatus'))
            : response()->api('Error creating task', 'Error creating task', config('global.serverErrorStatus'));
    }

    /**
     * @param Task $task
     * @param TaskRequest $request
     * @return mixed
     */
    public function update(Task $task, TaskRequest $request): mixed
    {
        return $this->updateTask($task, $request->toArray()) == config('global.successStatus')
            ? response()->api('Task updated successfully', 'Task updated successfully', config('global.successStatus'))
            : response()->api('Error updating task', 'Error updating task', config('global.serverErrorStatus'));
    }

    /**
     * @param Task $task
     * @return mixed
     */
    public function destroy(Task $task): mixed
    {
        return $this->deleteTask($task) == config('global.successStatus')
            ? response()->api('Task deleted successfully', 'Task deleted successfully', config('global.successStatus'))
            : response()->api('Error deleting task', 'Error deleting task', config('global.serverErrorStatus'));
    }
}
