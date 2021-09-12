<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function soal()
    {
        return $this->hasMany(Soal::class, 'kategori_id');
    }
}
