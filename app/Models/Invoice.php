<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $fillable = [
        'user_id',
        'pendaftaran_id',
        'nomor_invoice',
    ];

    // Each invoice owned one only one pendaftaran
    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
    // Each invoice owned one only one user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
