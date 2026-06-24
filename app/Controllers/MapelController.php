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
        $role = session()->get('role');

        if ($role == 'admin') {
            return redirect()->to(base_url('/admin/dashboard#data_soal'));
        }

        return redirect()->back()->with('error', 'Role tidak dikenali');
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

        if (session('role') == 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif (session('role') == 'guru') {
            return redirect()->to('/guru/dashboard');
        } else {
            return redirect()->to('/dashboard');
        }
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
        $jumlah = $this->request->getPost('jumlah_soal');

        if (!$jumlah) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'jumlah soal kosong'
            ]);
        }
        $pgessay = new PgEssayModel();

        $jumlah = $this->request->getPost('jumlah_soal');

        for ($i = 0; $i < $jumlah; $i++) {

            $gambar = $this->request->getFile('gambar_' . $i);

            $namaGambar = '';

            if (
                $gambar &&
                $gambar->isValid() &&
                !$gambar->hasMoved()
            ) {

                $namaGambar = $gambar->getRandomName();

                $folder = FCPATH . 'uploads/soal';

                if (!is_dir($folder)) {
                    mkdir($folder, 0777, true);
                }

                $gambar->move($folder, $namaGambar);
            }

            $data = [

                'id_mapel'   => $this->request->getPost('id_mapel'),
                'pertemuan'  => $this->request->getPost('pertemuan'),
                'tipe_soal'  => $this->request->getPost('tipe_soal'),
                'pertanyaan' => $this->request->getPost('soal_' . $i),

                'opsi_a' => $this->request->getPost('a_' . $i),
                'opsi_b' => $this->request->getPost('b_' . $i),
                'opsi_c' => $this->request->getPost('c_' . $i),
                'opsi_d' => $this->request->getPost('d_' . $i),

                'kunci' => $this->request->getPost('kunci_' . $i),

                'gambar' => $namaGambar
            ];

            $pgessay->insert($data);
        }

        return $this->response->setJSON([
            'status' => true
        ]);
    }

    public function updateSoal()
    {
        $soalModel = new PgEssayModel();

        $id_mapel = session()->get('id_mapel');
        $pertanyaan = $this->request->getPost('pertanyaan');
        $opsi_a     = $this->request->getPost('opsi_a');
        $opsi_b     = $this->request->getPost('opsi_b');
        $opsi_c     = $this->request->getPost('opsi_c');
        $opsi_d     = $this->request->getPost('opsi_d');
        $kunci      = $this->request->getPost('kunci');

        if (!$pertanyaan) {
            return redirect()->back()
                ->with('error', 'Data soal tidak ditemukan.');
        }

        foreach ($pertanyaan as $id_soal => $isiPertanyaan) {

            $data = [
                'id_mapel'   => $id_mapel,
                'pertanyaan' => $isiPertanyaan,
                'opsi_a'     => $opsi_a[$id_soal] ?? '',
                'opsi_b'     => $opsi_b[$id_soal] ?? '',
                'opsi_c'     => $opsi_c[$id_soal] ?? '',
                'opsi_d'     => $opsi_d[$id_soal] ?? '',
                'kunci'      => $kunci[$id_soal] ?? ''
            ];

            $soalModel->update($id_soal, $data);
        }

        return redirect()->back()
            ->with('success', 'Soal berhasil diperbarui.');
    }
    public function readNilai($id_user, $id_mapel, $pertemuan)
    {
        session()->set('detail_id_user', $id_user);
        session()->set('detail_id_mapel', $id_mapel);
        session()->set('detail_pertemuan', $pertemuan);

        $role = session()->get('role');

        if ($role == 'guru') {

            return redirect()->to(base_url('guru/dashboard#nilai-murid'));
        } elseif ($role == 'admin') {

            return redirect()->to(base_url('admin/dashboard#nilai-murid'));
        } elseif ($role == 'murid') {

            return redirect()->to(base_url('murid/dashboard#nilai-murid'));
        } else {

            return redirect()->to(base_url('dashboard'));
        }
    }
}
