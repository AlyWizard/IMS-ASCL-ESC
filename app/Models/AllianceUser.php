<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//modify the part here
class AllianceUser extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alliance_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'name',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Check if user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a standard user
     *
     * @return bool
     */
    public function isStandard()
    {
        return $this->role === 'standard';
    }

    /**
     * Check if user is a read-only user
     *
     * @return bool
     */
    public function isReadOnly()
    {
        return $this->role === 'readonly';
    }
}