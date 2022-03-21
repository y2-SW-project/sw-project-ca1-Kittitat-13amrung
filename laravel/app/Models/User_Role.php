<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_roles';

    public function getRole($requests) {
        return $this->where('user_id', $requests)->first();
    }
}
