<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'vacation_id', 'start', 'end'];
}
