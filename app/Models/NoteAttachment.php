<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'parent_type',
        'notes',
        'note_status'
    ];
}
