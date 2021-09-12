<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $table = 'soal';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->BelongsTo(Kategori::class, 'kategori_id');
    }
}
