<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PssCompany extends Model
{
    use HasFactory;

     protected $table ='pss_company';

     protected $fillable = [
        'name',
        'address',
        'status',
        'is_deleted',
        'created_by',
        'updated_by'
     ];

     public function branches() {
        return $this->hasMany(Branch::class, 'pss_company_id');
    }
}
