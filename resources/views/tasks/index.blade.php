@extends('layouts.default')

@section('content')
    <form action="{{ route('tasks.store') }}" method="POST" class="row">
        @csrf
        <div class="col-lg-4">
            <input type="text" name="title" placeholder="Title" class="form-control" required>
        </div>
        <div class="col-lg-12 my-3">
            <textarea name="description" placeholder="Description" rows="5" class="form-control w-100"></textarea>
        </div>
        <div class="col-lg-4">
            <input type="text" id="due_date" class="form-control" name="due_date" placeholder="تاریخ سررسید" required>
        </div>
        <div class="col-lg-4">
            <select name="priority" class="form-control">
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>
        <div class="col-lg-4">
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <div class="col-lg-4 mt-3">
            <button type="submit" class="btn btn-success">Create Task</button>
        </div>

    </form>

    <div id="app">
        <task-list></task-list>
    </div>
    <livewire:task-manager />

@endsection
