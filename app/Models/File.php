<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'size', 'uuid', 'path'
    ];

    public static function booted() {
        static::creating(function ($file) {
            $file->uuid = Str::uuid();
        });

        static::deleted(function ($file) {
            Storage::disk('s3')->delete($file->path);
        });
    }

    public function link() {
        return $this->hasOne(FileShare::class);
    }
}
