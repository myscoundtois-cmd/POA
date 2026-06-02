<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id_materi';
    protected $allowedFields = ['id_materi', 'id_mapel', 'nama_mapel', 'created_by', 'file_mapel', 'kelas', 'pertemuan', 'create_at'];
}
