<?php

namespace App\Controllers;

use App\Models\MapelModel;
use App\Models\MateriModel;
use App\Models\PgEssayModel;
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

    public function simpan()
    {
        $data = [

            'id_mapel'   => $this->request->getPost('id_mapel'),
            'judul'      => $this->request->getPost('judul'),
            'tipe_soal'  => $this->request->getPost('tipe_soal'),
            'pertemuan'  => $this->request->getPost('pertemuan'),
            'durasi'     => $this->request->getPost('durasi')

        ];

        $modelTugas = new TugasUjiModel();

        $modelTugas->insert($data);

        return $this->response->setJSON([
            'status' => true,
            'id_mapel' => $modelTugas->getInsertID()
        ]);
    }
    public function simpanSoal()
    {
        $pgessay = new PgEssayModel();

        $json = $this->request->getJSON(true);

        foreach ($json['soal'] as $row) {

            $pgessay->insert([

                'id_mapel' => $json['id_mapel'],
                'pertanyaan'     => $row['soal'],
                'opsi_a'        => $row['a'],
                'opsi_b'        => $row['b'],
                'opsi_c'        => $row['c'],
                'opsi_d'        => $row['d'],
                'kunci'    => $row['kunci']

            ]);
        }

        return $this->response->setJSON([
            'status' => true
        ]);
    }
}
