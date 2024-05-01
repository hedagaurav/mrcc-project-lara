<!-- resources/views/projects/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Project Details') }}</div>
                    <div class="card-body">
                        <p><strong>Project Code:</strong> {{ $project->project_code }}</p>
                        <p><strong>Project Name:</strong> {{ $project->project_name }}</p>
                        <!-- Add more details if needed -->
                        <p><strong>Tasks:</strong></p>
                        <ul type="none">
                            
                            @foreach ($project->tasks as $task)
                            <li>
                                <p><strong>Task Name:</strong> {{ $task->task_name }}</p>    
                                <p><strong>Task Hours:</strong>{{ $task->task_hours }}</p>    
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
