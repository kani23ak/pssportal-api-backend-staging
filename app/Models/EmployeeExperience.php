<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeExperience extends Model
{
    protected $table = 'employee_experiences';

    protected $fillable = [
        'employee_id',
        'job_title',
        'company_industry',
        'company_name',
        'previous_salary',
        'from_date',
        'to_date',
        'responsibilities',
        'verification_documents'
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'verification_documents' => 'array'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
