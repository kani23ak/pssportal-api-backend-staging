<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

     protected $fillable = [
        'parent_id',
        'notes',
        'created_date',
        'is_deleted'
    ];

    public function jobForm()
    {
        return $this->belongsTo(JobForm::class, 'parent_id');
    }
}
