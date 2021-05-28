<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectStup extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_name','subject_code','role','status'
    ];
}
