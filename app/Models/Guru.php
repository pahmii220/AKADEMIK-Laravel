<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru'; // nama tabel dalam database

    protected $fillable = [
        'nip',
        'nama_guru',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'status_pegawai',
        'keahlian_utama',
        'pendidikan_terakhir',
        'tahun_aktif_kerja',
    ];
}
