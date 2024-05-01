<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('tasks')->get();
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validate = Validator::make($request->all(), [
                'project_code' => 'required|unique:projects',
                'project_name' => 'required',
                'task_name.*' => 'required',
                'task_hours.*' => 'required|numeric',
            ]);

            if ($validate->fails()) {
                $errors = $validate->errors()->toArray();

                return response()->json(['success' => false, 'errors' => $errors], 422);
            }

            $validated_data = $validate->safe()->all();
            $project_formdata = [
                'project_code' => $validated_data['project_code'],
                'project_name' => $validated_data['project_name'],
            ];

            $project = Project::create($project_formdata);

            $tasks_formdata = [];

            foreach ($validated_data['task_name'] as $index => $data) {
                $task_name = $validated_data['task_name'][$index];
                $task_hours = $validated_data['task_hours'][$index];

                $tasks_formdata[] = [
                    'task_name' => isset($task_name) ? $task_name : '',
                    'task_hours' => isset($task_hours) ? $task_hours : 0,
                    'project_id' => $project->id
                ];
            }
            $tasks = $project->tasks()->createMany($tasks_formdata);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Project created successfully', 'project' => $project, 'tasks' => $tasks]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project->load('tasks');
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project->load('tasks');
        return view('project.edit', compact('project'));
        // return view('layouts.common_footer');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        try {
            $validate = Validator::make($request->all(), [
                // 'project_id' => 'integer',
                'project_code' => 'required',
                'project_name' => 'required',
                // 'task_id.*' => 'integer',
                'task_name.*' => 'required',
                'task_hours.*' => 'required|numeric',
            ]);

            if ($validate->fails()) {
                $errors = $validate->errors()->toArray();

                return response()->json(['success' => false, 'errors' => $errors], 422);
            }

            $validated_data = $validate->safe()->all();

            $project_formdata = [
                // 'id' => $validated_data['project_id'],
                // 'project_code' => $validated_data['project_code'],
                'project_name' => $validated_data['project_name'],
            ];

            $project_data = Project::where('project_code', $validated_data['project_code'])->first();
            
            if($project_data == null){
                $project_formdata['project_code'] = $validated_data['project_code'];
            }

            $project->update($project_formdata);

            /* delete old tasks related to poject and add new task to update
                the task related to the project.
            */

            $project->tasks()->delete();

            $tasks_formdata = [];

            foreach ($validated_data['task_name'] as $index => $data) {
                $task_name = $validated_data['task_name'][$index];
                $task_hours = $validated_data['task_hours'][$index];

                $tasks_formdata[] = [
                    'task_name' => isset($task_name) ? $task_name : '',
                    'task_hours' => isset($task_hours) ? $task_hours : 0,
                    'project_id' => $project->id
                ];
            }
            $tasks = $project->tasks()->createMany($tasks_formdata);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Project created successfully', 'project' => $project, 'tasks' => $tasks]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('project.index')
            ->with('success', 'Project deleted successfully.');
    }
}
