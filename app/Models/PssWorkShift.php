<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PssWorkShift extends Model
{
    use HasFactory;

    protected $table='pss_work_shifts';

    protected $fillable = [
        'shift_name',
        'start_time',
        'end_time',
        'created_by',
        'updated_by',
        'is_deleted',
    ];
}
