<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $fillable = [
        'product_id',
        'user_id',
        'periode_id',
        'subtotal',
        'virtual_account',
        'status_pembayaran',
    ];

    // Each pendaftaran owned belongsTo user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Each pendaftaran owned belongsTo user
    public function invoice(){
        return $this->hasOne(Invoice::class, 'id');
    }

    // Pendaftaran belongsTo product
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    // Each pendaftaran belongsTo periode
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
}
