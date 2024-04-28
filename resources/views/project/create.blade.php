<!-- resources/views/projects/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Project') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('project.store') }}" id="createProjectForm">
                            @csrf

                            <div class="form-group">
                                <label for="project_code">{{ __('Project Code') }}</label>
                                <input id="project_code" type="text"
                                    class="form-control @error('project_code') is-invalid @enderror" name="project_code"
                                    value="{{ old('project_code') }}" required autofocus>
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
                                    value="{{ old('project_name') }}" required>
                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="task-hours-list">
                                <div class="task-hours-item">
                                    
                                    <div class="form-group">
                                        <label for="task_name">{{ __('Task Name') }}</label>
                                        <input id="task_name" type="text" class="form-control @error('task_name') is-invalid @enderror" name="task_name[]" value="{{ old('task_name') }}">
                                        @error('task_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="task_hours">{{ __('Task Hours') }}</label>
                                        <input type="text"
                                        class="form-control @error('task_hours.*') is-invalid @enderror" name="task_hours[]"
                                        value="{{ old('task_hours') }}">
                                        <input type="button" class="delete-task" value="del">
                                    </div>
                                    @error('task_hours.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="button" id="add-task" value="add">

                            <button type="submit" class="btn btn-primary">
                                {{ __('Create') }}
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
        let task_item = $('.task-hours-item').first();
        let task_item_clone = task_item.clone();
        $(document).ready(function() {
            task_item.find('.delete-task').remove();
        });

        $('#add-task').click(() => {
            $('.task-hours-list').append(task_item_clone.clone());

        });

        $(document).on('click', '.delete-task', function() {
            $(this).closest('.task-hours-item').remove();
        });

        $('#createProjectForm').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            
            console.log($(this).serialize())
            $.ajax({
                type: 'POST',
                url: '{{ route("project.store") }}',
                data: $(this).serialize(),
                cache: false,
                success: function(response) {
                    if(response.success == false){
                        console.log(response);

                    }else if(response.success == true){
                        // console.log(response);

                        // Reset form fields
                        $('#createProjectForm')[0].reset();
                        
                        // redirect to list page
                        window.location = '{{ route("project.index") }}';
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
                        console.log('An error occurred while processing the request.',xhr.responseJSON);
                    }
                }
            });
        });
    </script>
@endsection
