<?php
namespace App\Repository\Admin\Tables;
use App\Interface\Admin\Tables\TableInterface;
use App\Models\Employee\Employee;
use App\Models\Project\Project;
use App\Models\WorkTime\WorkTime;
use App\Models\Modul\Modul;

class TableRepository implements TableInterface
{


    public function getTableData(string $key)
    {
        return match($key) {
            'Employees' => Employee::select('id','name','salary')->get(),
            'Projects' => Project::select('id','name','start_date','end_date','total_days','total_employees','total_cost','status')->get(),
            'Modules' => Modul::select('date','employee','name as modul_name','project','hours')->get(),
            'WorkTimes' => WorkTime::with(['employee', 'project', 'modul'])
                        ->orderBy('date', 'desc')
                        ->get()
                        ->map(function ($item) {
                            return [
                                'id' => $item->id,
                                'date' => $item->date,
                                'hours' => $item->hours,
                                'employee' => $item->employee->name ?? '—',
                                'project' => $item->project->name ?? '—',
                                'module' => $item->modul->name ?? '—',
                            ];
                        }),

        };
    }
}