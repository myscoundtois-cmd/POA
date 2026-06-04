<?php

namespace App\Controllers;

use App\Models\MapelModel;
use App\Models\MateriModel;
use App\Models\PgEssayModel;
use App\Models\TugasUjiModel;

class MapelController extends BaseController
{
    public function Read($id_mapel, $pertemuan)
    {
        session()->set('id_mapel', $id_mapel);
        session()->set('pertemuan', $pertemuan);

        return redirect()->to(
            base_url('/admin/dashboard#data_soal')
        );
    }

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

        if (!$json) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Data JSON tidak ditemukan'
            ]);
        }

        $tipe = $json['tipe_soal'] ?? '';

        foreach ($json['soal'] as $row) {

            $data = [

                'id_mapel'   => $json['id_mapel'],
                'pertemuan'  => $json['pertemuan'] ?? null,
                'tipe_soal'  => $tipe,
                'pertanyaan' => $row['soal']

            ];

            if ($tipe === 'pg') {

                $data['opsi_a'] = $row['a'] ?? null;
                $data['opsi_b'] = $row['b'] ?? null;
                $data['opsi_c'] = $row['c'] ?? null;
                $data['opsi_d'] = $row['d'] ?? null;
                $data['kunci']  = $row['kunci'] ?? null;
            } else {

                $data['opsi_a'] = null;
                $data['opsi_b'] = null;
                $data['opsi_c'] = null;
                $data['opsi_d'] = null;
                $data['kunci']  = null;
            }

            $pgessay->insert($data);
        }

        return $this->response->setJSON([
            'status' => true
        ]);
    }
}
