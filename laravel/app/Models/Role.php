<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // declare a many to many relationship between roles and users table
    // then assign their ids to the foreign table of user_roles
    public function users() {
        return $this->belongsToMany('App\Models\User', 'user_roles');
    }
}
