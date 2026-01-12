<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractEmployeeDocument extends Model
{
    use HasFactory;

    protected $table='contract_employee_documents';

     protected $fillable = [
        'employee_id',
        'document_path',
        'original_name'
    ];
}
