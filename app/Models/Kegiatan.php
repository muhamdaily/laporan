<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'uraian_kegiatan',
        'hasil_kegiatan',
        'kendala',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
