<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    
    protected $fillable = [
        'nama',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // each user have many pendaftaran
    public function pendaftaran(){
        return $this->hasMany(Pendaftaran::class, 'id');
    }

    // each user have many invoice
    public function invoice(){
        return $this->hasMany(Invoice::class, 'id');
    }

    // Each user has One user profile
    public function profile(){
        // return $this->hasOne(ProfileUser::class, 'id');
        return $this->hasOne(ProfileUser::class, 'user_id');
    }
}
