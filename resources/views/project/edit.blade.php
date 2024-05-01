<!-- resources/views/projects/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Project') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('project.update', $project->id) }}" id="updateProjectForm">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="project_code">{{ __('Project Code') }}</label>
                                <input id="project_code" type="text"
                                    class="form-control @error('project_code') is-invalid @enderror" name="project_code"
                                    value="{{ old('project_code', $project->project_code) }}" required autofocus>
                                @error('project_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="project_name">{{ __('Project Name') }}</label>
                                <input id="project_name" type="text"
                                    class="form-control @error('project_name') is-invalid @enderror" name="project_name"
                                    value="{{ old('project_name', $project->project_name) }}" required>
                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="task-hours-list">
                                @foreach ($project->tasks as $task)
                                    <div class="task-hours-item">

                                        <div class="form-group">
                                            <label for="task_name">{{ __('Task Name') }}</label>
                                            <input id="task_name" type="text"
                                                class="form-control @error('task_name.*') is-invalid @enderror"
                                                name="task_name[]" value="{{ $task->task_name }}">
                                            @error('task_name.*')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="task_hours">{{ __('Task Hours') }}</label>
                                            <input type="text"
                                                class="form-control @error('task_hours.*') is-invalid @enderror"
                                                name="task_hours[]" value="{{ $task->task_hours }}">
                                            <input type="button" class="delete-task" value="del">
                                        </div>
                                        @error('task_hours.*')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                @endforeach
                            </div>

                            <input type="button" id="add-task" value="add">
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

@section('footer-js')
    <script>
        $('#updateProjectForm').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // console.log($(this).serialize());
            $.ajax({
                type: 'PUT',
                url: '{{ route('project.update',$project->id) }}',
                data: $(this).serialize(),
                cache: false,
                success: function(response) {
                    if (response.success == false) {
                        console.log(response);

                    } else if (response.success == true) {
                        // Reset form fields
                        $('#updateProjectForm')[0].reset();

                        // redirect to list page
                        window.location = '{{ route('project.index') }}';
                    }

                    // Handle success response
                },
                error: function(xhr) {
                    // Handle validation errors
                    console.log(xhr);
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '_error').text(value[0]);
                        });
                    } else {
                        console.log('An error occurred while processing the request.', xhr
                            .responseJSON);
                    }
                }
            });
        });
    </script>
@endsection
