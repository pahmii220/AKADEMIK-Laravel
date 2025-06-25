<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'student_id',
        'guru_id',
        'nilai',
        'keterangan_nilai',
        'sikap',
        'tahun_ajaran',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
