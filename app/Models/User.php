<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'role_id','email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
       'role_id', 'password', 'remember_token',
    ];

    /**
     * Get all of the curses for the user.
     */
    public function curses()
    {
        return $this->hasMany(Course::class);
    }
}
