<?php

namespace App\Models;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        $userid = Auth::user()->id;
        foreach ($this->where('id', $userid)->get() as $user) {
            if ($user->role_id == 1) {
                return true;
            }
        }
        return false;
    }

    public function isCustomer()
    {
        $userid = Auth::user()->id;
        foreach ($this->where('id', $userid)->get() as $user) {
            if ($user->role_id == 2) {
                return true;
            }
        }
        return false;
    }

    public function customer()
    {
        return $this->hasOne(Customers::class);
    }

}
