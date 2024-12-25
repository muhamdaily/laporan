<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'kegiatan_id',
        'file_name',
        'file_path',
        'file_type'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
