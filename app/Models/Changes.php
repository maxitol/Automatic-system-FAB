<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changes extends Model
{
    protected $table = 'Changes';
    protected $guarded = false;
    use HasFactory;
}
