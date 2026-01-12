<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'department_id',
        'status',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_date',
        'company_id',  
    ];

    // Role → Company
    public function company()
    {
        return $this->belongsTo(PssCompany::class, 'company_id');
    }
    
    // ✅ One role belongs to one department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}

