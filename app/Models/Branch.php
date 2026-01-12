<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table ='branches';

     protected $fillable = [
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'status',
        'is_deleted',
        'created_by',
        'updated_by',
        'branch_name',
        'company_id',
    ];

    public function company() {
        return $this->belongsTo(PssCompany::class, 'company_id');
    }
}
