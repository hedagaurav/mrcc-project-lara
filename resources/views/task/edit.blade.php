<!-- resources/views/tasks/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Task') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('task.update', $task->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="task_name">{{ __('Task Name') }}</label>
                                <input id="task_name" type="text" class="form-control @error('task_name') is-invalid @enderror" name="task_name" value="{{ old('task_name', $task->task_name) }}" required autofocus>
                                @error('task_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="task_hours">{{ __('Task Hours') }}</label>
                                <input id="task_hours" type="text" class="form-control @error('task_hours') is-invalid @enderror" name="task_hours" value="{{ old('task_hours', $task->task_hours) }}" required>
                                @error('task_hours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
