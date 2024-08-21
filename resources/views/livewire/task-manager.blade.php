<div class="card p-5 mt-5">
    <div class="card-title">
        <h2>Tasks</h2>
    </div>
    <ul class="ps-3 mt-2">
        @foreach($tasks as $task)
            <li class="mb-3" style="list-style-type: none;">
                <div class="card p-2 d-flex justify-content-center align-items-start">
                    <div class="d-flex flex-row justify-content-between align-items-center w-100">
                        <p class="fw-bold">
                            {{ $task->title }}
                        </p>
                        <span class="text-white px-2" style="background-color: #28a745; border-radius: 8px; font-size: 13px;">
                            {{ str_replace('_', ' ', $task->status) }}
                        </span>
                    </div>
                    <small>{{ $task->due_date }}</small>
                </div>
            </li>
        @endforeach
    </ul>
</div>
