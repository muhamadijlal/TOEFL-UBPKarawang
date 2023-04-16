<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "periode";

    protected $fillable = [
        'nama_periode',
        'start_periode',
        'end_periode',
        'expired_periode',
        'status',
    ];

    // each periode has many pendftaran
    public function pendaftaran(){
        return $this->hasMany(Pendaftaran::class, 'id');
    }
}
