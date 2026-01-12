<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    // ✅ ADD THIS
    protected $fillable = [
        'privilege_for',
        'role_id',
        'status',
        'is_deleted',
        'created_by',
        'created_date'
    ];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id')->select('role_name', 'id');
    }

    public function modules()
    {
        return $this->hasMany(ModulePermission::class, 'permission_id', 'id');
        // ->select('module','is_create','is_view','is_edit','is_delete','is_import','is_filter');
    }


    public function modulesP()
    {
        return $this->hasMany(ModulePermission::class, 'permission_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'role_id', 'id')
            ->select('id', 'full_name', 'role_id'); // ✅ MUST include role_id
    }
}
