<?php

namespace App\Controllers;

use App\Models\MapelModel;

class MapelController extends BaseController
{

    public function create()
    {
        $model = new MapelModel();
        $data = [
            'nama_mapel' => $this->request->getPost('nampel'),
            'kelas' => $this->request->getPost('kelas'),
            'created_by' => $this->request->getPost('guru'),
        ];
        $model->insert($data);
        return redirect()->to('/admin/dashboard');
    }
}
