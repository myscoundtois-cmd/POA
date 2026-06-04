<?php

namespace App\Models;

use CodeIgniter\Model;

class PgEssayModel extends Model
{
    protected $table = 'soal';

    protected $primaryKey = 'id_soal';

    protected $allowedFields = [
        'id_mapel',
        'pertemuan',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban',
        'kunci',
        'gambar'
    ];
}
