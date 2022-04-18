<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Overtrue\LaravelLike\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory, Favoriteable, Likeable;

    protected $fillable = ['user_id'];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes() {
        return $this->belongsTo(Like::class, 'user_id');
    }

}
