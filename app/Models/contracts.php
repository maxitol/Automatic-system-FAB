<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contracts extends Model
{
    protected $table = 'contracts';
    protected $guarded = false;
    use HasFactory;
}
