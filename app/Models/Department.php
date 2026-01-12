<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // ✅ Table name
    protected $table = 'departments';

    // ✅ Mass assignable fields
    protected $fillable = [
        'department_name',
        'status',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_date',
        'company_id',
    ];

    public function company() {
        return $this->belongsTo(PssCompany::class, 'company_id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'department_id');
    }
}
