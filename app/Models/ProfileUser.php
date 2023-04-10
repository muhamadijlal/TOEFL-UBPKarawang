<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    use HasFactory;

    protected $table = "profile";

    protected $fillable = [
        'user_id',
        'nim',
        'no_handphone',
        'semester',
        'program_studi'
    ];

    // Each profile belongsTo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
