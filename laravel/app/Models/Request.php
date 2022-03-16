<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Request extends Model
{
    // use HasFactory;
    protected $attributes = [
        'digital_art' => false,
        'traditional_art' => false,
        'pixel_art' => false,
    ];

    public function getDaysAttribute() {
        if ($this->end_date) {
            $days = Carbon::now()->diffInDays(Carbon::parse($this->end_date));
        } else {
            $days = 0;
        }
        return $days;
    }

    public function users() {
        return $this->belongsToMany('App\Models\User', 'user_requests');
    }
}
