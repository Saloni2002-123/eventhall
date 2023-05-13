<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    protected $table = 'hall_lists';
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

}
