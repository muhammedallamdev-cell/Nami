<?php

namespace App\Models\WorkTime;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee\Employee;
use App\Models\Project\Project;
use App\Models\Modul\Modul;

class WorkTime extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id');
    }
}

