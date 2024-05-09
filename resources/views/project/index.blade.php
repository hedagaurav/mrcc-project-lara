<!-- resources/views/projects/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Projects') }}</div>

                <div class="card-body">
                    <label for="project-table-search">Search Table:</label>
                    <input type="text" id="project-table-search" placeholder="Search...">

                    <table class="table" id="projects_table">
                        <thead>
                            <tr>
                                <th>Project Code</th>
                                <th>Project Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td class="project_code">{{ $project->project_code }}</td>
                                <td ><span class="project_name">{{ $project->project_name }}</span>
                                    @foreach ($project->tasks as $task)
                                    <p>Task Name: {{ $task->task_name }} Task Hours: {{ $task->task_hours }} hours</p>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('project.show', $project->id) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('project.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td></td>
                                <td>
                                    
                                </td>
                            </tr> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection