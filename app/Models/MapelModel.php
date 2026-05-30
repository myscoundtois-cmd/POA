<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';
    protected $allowedFields = ['id_mapel', 'nama_mapel', 'kelas', 'created_by', 'updated_at'];
}
