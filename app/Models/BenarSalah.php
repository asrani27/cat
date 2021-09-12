<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenarSalah extends Model
{
    use HasFactory;
    protected $table = 'benarsalah';
    protected $guarded = ['id'];
    public $timestamps = false;
}
