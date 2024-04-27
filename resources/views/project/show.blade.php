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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
