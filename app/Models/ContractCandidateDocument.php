<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractCandidateDocument extends Model
{
    use HasFactory;

    protected $table='contract_candidate_documents';

     protected $fillable = [
        'employee_id',
        'document_path',
        'original_name'
    ];
}
