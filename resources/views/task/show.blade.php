<!-- resources/views/tasks/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task Details') }}</div>

                    <div class="card-body">
                        <p><strong>Task Name:</strong> {{ $task->task_name }}</p>
                        <p><strong>Task Hours:</strong> {{ $task->task_hours }}</p>
                        <!-- Add more details if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
