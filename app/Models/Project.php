<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['project_code', 'project_name'];

    // Define the one-to-many relationship with Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
