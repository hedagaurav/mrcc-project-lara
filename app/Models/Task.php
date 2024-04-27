<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['task_name', 'task_hours','project_id'];

    // Define the inverse of the one-to-many relationship with Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
