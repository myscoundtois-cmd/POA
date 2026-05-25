<?php

namespace App\Models;

use CodeIgniter\Model;

class DataUserModel extends Model
{
    protected $table = 'data_user';

    protected $primaryKey = 'id_dataUser';

    protected $allowedFields = [
        'nama',
        'foto',
        'email',
        'id_user'
    ];
}
