<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_surat',
         'tanggal_surat',

                'jenis_surat',

                'penerima',

                'perihal',

                'klasifikasi_id',

                'keterangan',

                'pengirim'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi_id');
    }
}
