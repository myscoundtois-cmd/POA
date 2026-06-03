<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasUjiModel extends Model
{
    protected $table = 'tugasuji';

    protected $primaryKey = 'id_tugas';

    protected $allowedFields = [
        'id_mapel',
        'judul',
        'pertemuan',
        'tipe_soal',
        'durasi'
    ];
}
