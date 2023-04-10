<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = "periode";

    protected $fillable = [
        'nama_periode',
        'start_periode',
        'end_periode',
    ];

    // each periode has many pendftaran
    public function pendaftaran(){
        return $this->hasMany(Pendaftaran::class, 'id');
    }
}
