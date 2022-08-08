<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offdayuser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'period' , 'vacation_id'];
}
