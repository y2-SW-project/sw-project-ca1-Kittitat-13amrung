<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Model\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // a function to check users if they are authorized to perform certain actions 
    public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
            abort (401, 'This action is unauthorized');
        }
        return $this->hasRole($roles) ||
        abort(401, 'This action is unauthorized');
        }
    
        public function hasRole($role) {
            return null !== $this->roles()->where('name', $role)->first();
        }
        
        // 
        public function hasAnyRole($roles) {
            return null !== $this->roles()->whereIn('name', $roles)->first();
        }

        // make a many to many relationship between roles and users table
        // to the foreign table of user_roles 
    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'user_roles');
    }

    public function authorizeRequest($requests) {
        if (is_array($requests)) {
            return $this->hasAnyRequest($requests) ||
            abort (401, 'This action is unauthorized');
        }
        return $this->hasRequest($requests) ||
        abort(401, 'This action is unauthorized');
        }
    
        public function hasRequests($requests) {
            return null !== $this->requests()->where('name', $request)->first();
        }
        
        // 
        public function hasAnyRequest($requests) {
            return null !== $this->requests()->whereIn('name', $requests)->first();
        }

        public function assignRole($role) {
            $role = Role::where('name',$role->name)->get()->first();
            return $this->roles->save($role);
        }

        // make a many to many relationship between roles and users table
        // to the foreign table of user_roles 
    public function requests() {
        return $this->hasMany(Request::class);
    }

    public function messages()
        {
        return $this->hasMany(Message::class);
        }

    public function artist() {
        return $this->hasOne(Artist::class);
    }
}
