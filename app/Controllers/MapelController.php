<?php

namespace App\Controllers;

use App\Models\MapelModel;
use App\Models\MateriModel;
use App\Models\TugasUjiModel;

class MapelController extends BaseController
{

    public function create()
    {
        $model = new MapelModel();
        $data = [
            'nama_mapel' => $this->request->getPost('nama_mapel'),
            'kelas' => $this->request->getPost('kelas'),
            'created_by' => $this->request->getPost('guru'),
        ];
        $model->insert($data);
        return redirect()->to('/admin/dashboard');
    }

    public function c_materi()
    {
        $model = new MateriModel();
        $data = [
            'id_mapel' => $this->request->getPost('id_mapel'),
            'nama_mapel' => $this->request->getPost('nama_mapel'),
            'kelas' => $this->request->getPost('kelas'),
            'pertemuan' => $this->request->getPost('pertemuan'),
            'created_by' => $this->request->getPost('guru'),
            'file_mapel' => $this->request->getFile('file_mapel')->store()
        ];

        $model->insert($data);
        return redirect()->to('/admin/dashboard');
    }

    public function simpanSoal()
    {
        $ujianModel = new TugasUjiModel();

        $data = [
            'id_mapel'  => $this->request->getPost('id_mapel'),
            'judul'     => $this->request->getPost('judul'),
            'pertemuan' => $this->request->getPost('pertemuan'),
            'tipe_soal' => $this->request->getPost('tipe_soal'),
            'durasi'    => $this->request->getPost('durasi'),
        ];

        $ujianModel->insert($data);

        session()->setFlashdata('id_mapel', $data['id_mapel']);
        session()->setFlashdata('show_pgessay', true);

        return redirect()->to('/admin/dashboard');
    }
}
