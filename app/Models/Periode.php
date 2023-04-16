<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "periode";

    protected $fillable = [
        'nama_periode',
        'product_id',
        'start_periode',
        'end_periode',
        'expired_periode',
        'status',
    ];

    // each periode has many pendftaran
    public function pendaftaran(){
        return $this->hasMany(Pendaftaran::class, 'id');
    }

    // Each periode hasOne product id
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
