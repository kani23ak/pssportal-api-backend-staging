<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    protected $table = 'employee_documents';
    protected $fillable = [
        'document_group_id',
        'file_path',
        'original_name'
    ];

    public function documentGroup()
    {
        return $this->belongsTo(EmployeeDocumentGroup::class);
    }
}
