<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Request extends Model
{
    use HasFactory;
    
    protected $attributes = [
        'digital_art' => false,
        'traditional_art' => false,
        'pixel_art' => false,
    ];

    public function getDaysAttribute() {
        $now = Carbon::now();
        if ($this->end_date) {
            $days = Carbon::now()->diffForHumans(Carbon::parse($this->end_date));
            // dd($days);
        } else {
            $days = 0;
        }
        return $days;
    }

    public function users() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
