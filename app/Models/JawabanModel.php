<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabanModel extends Model
{
    protected $table      = 'jawabansiswa';
    protected $primaryKey = 'id_jawaban';

    protected $allowedFields = [
        'id_user',
        'pertemuan',
        'nama_siswa',
        'jawaban',
        'nilai',
        'create_at'
    ];

    protected $useTimestamps = false;

    // kalau kamu mau otomatis isi create_at
    protected $beforeInsert = ['setCreatedAt'];

    protected function setCreatedAt(array $data)
    {
        if (!isset($data['data']['create_at'])) {
            $data['data']['create_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }
}
