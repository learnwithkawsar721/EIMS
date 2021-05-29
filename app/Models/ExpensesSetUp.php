<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesSetUp extends Model
{
    use HasFactory;
    protected $fillable = ['expenses_name','role','status'];
}
