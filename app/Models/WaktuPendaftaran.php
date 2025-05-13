<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPendaftaran extends Model
{
    use HasFactory;
    protected $table = 'waktu_pendaftaran';
    protected $guarded = ['id'];
    public $timestamps = false;
}
