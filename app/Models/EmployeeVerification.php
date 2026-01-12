<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeVerification extends Model
{
    protected $table = 'employee_verifications';
    protected $fillable = [
        'employee_id',
        'document_type',
        'is_verified',
        'created_date'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
