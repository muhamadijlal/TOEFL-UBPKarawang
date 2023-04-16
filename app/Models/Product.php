<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'bahasa',
        'jenis',
        'harga'
    ];

    // product has many pendaftaran
    public function pendaftaran()
    {
        return $this->hasManny(Pendaftaran::class,'id');
    }

    // product hasOne periode
    public function periode()
    {
        return $this->hasOne(Periode::class, 'id');
    }
}
