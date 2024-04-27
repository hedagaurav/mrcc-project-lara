<!-- resources/views/projects/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Project') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('project.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="project_code">{{ __('Project Code') }}</label>
                                <input id="project_code" type="text" class="form-control @error('project_code') is-invalid @enderror" name="project_code" value="{{ old('project_code') }}" required autofocus>
                                @error('project_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="project_name">{{ __('Project Name') }}</label>
                                <input id="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" name="project_name" value="{{ old('project_name') }}" required>
                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

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
