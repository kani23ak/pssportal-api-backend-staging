<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;

    protected $table = 'contact_details';

    protected $fillable = [
        'parent_id',
        'parent_type',
        'name',
        'role',
        'relationship',
        'phone_number'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'parent_id');
    }
}
