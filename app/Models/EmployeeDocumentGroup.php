<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocumentGroup extends Model
{
    protected $table = 'employee_document_groups';
    protected $fillable = [
        'employee_id',
        'title'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class, 'document_group_id');
    }
}
