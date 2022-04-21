<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Overtrue\LaravelLike\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Artist extends Model
{
    use HasFactory, Favoriteable, Likeable;

    protected $fillable = ['user_id'];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDaysAttribute() {
        $now = Carbon::now();
        if ($this->users->last_seen) {
            $days = '('.Carbon::parse($this->users->last_seen)->diffForHumans() . ')';
            // dd($days);
        } else {
            $days = '';
        }
        return $days;
    }

}
