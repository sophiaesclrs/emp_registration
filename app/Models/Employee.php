<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'profile_picture',
        'full_name',
        'age',
        'birth',
        'phone',
        'email',
        'gender',
        'status',
        'work',
        'type',
        'address',
    ];
}