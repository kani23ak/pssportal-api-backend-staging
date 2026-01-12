<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    protected $table = 'employee_educations';
    protected $fillable = [
        'employee_id',
        'school_name',
        'department_name',
        'year_of_passing'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
