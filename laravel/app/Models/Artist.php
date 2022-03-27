<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    // use HasFactory;

    public function users() {
        return $this->belongsTo('App\Models\User', 'user_artists');
    }

    public function images()
    {
    return $this->hasMany(Image::class);
    }
}
