<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;
use App\Models\MapelModel;
use App\Models\MateriModel;
use App\Models\PgEssayModel;
use App\Models\TugasUjiModel;

class GuruController extends BaseController
{

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        if (session()->get('role') != 'guru') {
            return redirect()->to('/');
        }

        $mapelModel = new MapelModel();
        $materiModel = new MateriModel();
        $userModel = new UsersModel();
        $pgEssayModel = new PgEssayModel();
        $model = new DataUserModel();

        $data['siswa'] = $model->findAll();

        $data['kelas'] = $model
            ->select('kelas, COUNT(*) as jumlah_siswa')
            ->groupBy('kelas')
            ->orderBy('kelas', 'ASC')
            ->findAll();

        $pgEssayModel = new PgEssayModel();

        $data['soal'] = $pgEssayModel
            ->select('soal.*, tugasuji.*')
            ->join(
                'tugasuji',
                'tugasuji.id_mapel = soal.id_mapel
         AND tugasuji.pertemuan = soal.pertemuan'
            )
            ->where('soal.id_mapel', session()->get('id_mapel'))
            ->where('soal.pertemuan', session()->get('pertemuan'))
            ->findAll();

        $data['mapel'] = $mapelModel->findAll();

        $data['materi'] = $materiModel->findAll();

        // Data guru untuk dropdown pengajar di halaman mapel
        $data['guru'] = $userModel
            ->select('users.id_user, users.email, users.role, data_user.nama, data_user.nis, data_user.jenis_kelamin, data_user.alamat, data_user.tgl_lahir, data_user.kelas, data_user.foto')
            ->join('data_user', 'data_user.id_user = users.id_user', 'left')
            ->where('users.role', 'guru')
            ->findAll();

        // Data siswa untuk halaman Data Siswa
        $data['siswa'] = $userModel
            ->select('users.id_user, users.email, users.role, data_user.nama, data_user.nis, data_user.jenis_kelamin, data_user.alamat, data_user.tgl_lahir, data_user.kelas, data_user.foto')
            ->join('data_user', 'data_user.id_user = users.id_user', 'left')
            ->where('users.role', 'murid')
            ->findAll();

        $db = db_connect();

        $data['tugasUji'] = $db->table('tugasuji')
            ->select('
        tugasuji.id_tugas,
        tugasuji.id_mapel,
        tugasuji.judul,
        tugasuji.pertemuan,
        tugasuji.tipe_soal,
        tugasuji.durasi,
        mapel.nama_mapel,
        mapel.kelas,
        mapel.created_by,
        COUNT(soal.id_soal) as jumlah_soal
    ')
            ->join('mapel', 'mapel.id_mapel = tugasuji.id_mapel', 'left')
            ->join('soal', 'soal.id_mapel = tugasuji.id_tugas', 'left')
            ->groupBy('
        tugasuji.id_tugas,
        tugasuji.id_mapel,
        tugasuji.judul,
        tugasuji.pertemuan,
        tugasuji.tipe_soal,
        tugasuji.durasi,
        mapel.nama_mapel,
        mapel.kelas,
        mapel.created_by
    ')
            ->orderBy('tugasuji.id_tugas', 'DESC')
            ->get()
            ->getResultArray();

        $jawabanModel = new \App\Models\JawabanModel();
        $data['total_siswa'] = count($data['siswa']);
        $data['total_guru']  = count($data['guru']);
        $data['total_kelas'] = count($data['kelas']);
        $data['total_mapel'] = count($data['mapel']);

        $detailUser      = session()->get('detail_id_user');
        $detailMapel     = session()->get('detail_id_mapel');
        $detailPertemuan = session()->get('detail_pertemuan');

        $data['detailNilai'] = [];

        if (
            !empty($detailUser) &&
            !empty($detailMapel) &&
            !empty($detailPertemuan)
        ) {

            $data['detailNilai'] = $jawabanModel
                ->select('jawabansiswa.*, data_user.nama as nama_siswa')
                ->join(
                    'data_user',
                    'data_user.id_user = jawabansiswa.id_user',
                    'left'
                )
                ->where('jawabansiswa.id_user', $detailUser)
                ->where('jawabansiswa.id_mapel', $detailMapel)
                ->where('jawabansiswa.pertemuan', $detailPertemuan)
                ->first();

            $data['mapelDetail'] = $mapelModel
                ->where('id_mapel', $detailMapel)
                ->first();

            // Ambil semua soal yang sesuai
            $data['detailSoal'] = $pgEssayModel
                ->select('soal.*, tugasuji.*')
                ->join(
                    'tugasuji',
                    'tugasuji.id_mapel = soal.id_mapel
            AND tugasuji.pertemuan = soal.pertemuan'
                )
                ->where('soal.id_mapel', $detailMapel)
                ->where('soal.pertemuan', $detailPertemuan)
                ->orderBy('soal.id_soal', 'ASC')
                ->findAll();

            $data['jawabanParsed'] = [];

            if (!empty($data['detailNilai']['jawaban'])) {

                $listJawaban = explode(',', $data['detailNilai']['jawaban']);

                foreach ($listJawaban as $item) {

                    $pecah = explode('.', $item, 2);

                    if (count($pecah) == 2) {
                        $data['jawabanParsed'][$pecah[0]] = $pecah[1];
                    }
                }
            }
        } else {

            $data['detailNilai'] = [];
            $data['mapelDetail'] = [];
            $data['detailSoal'] = [];
            $data['jawabanParsed'] = [];
        }

        $data['jawabanSiswa'] = $jawabanModel->findAll();
        return view('content/dashboard', $data);
    }


    public function lihatMateri($folder, $file)
    {
        $path = WRITEPATH . 'uploads/' . $folder . '/' . $file;

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response->download($path, null);
    }

    public function koreksi()
    {
        $jawabanModel = new \App\Models\JawabanModel();

        $idJawaban = $this->request->getPost('id_jawaban');
        $status    = $this->request->getPost('status');

        $jumlahBenar = 0;
        $jumlahSoal  = count($status);

        foreach ($status as $nilai) {

            if ($nilai == 'benar') {
                $jumlahBenar++;
            }
        }

        $nilaiAkhir = 0;

        if ($jumlahSoal > 0) {
            $nilaiAkhir = round(($jumlahBenar / $jumlahSoal) * 100);
        }

        $jawabanModel->update($idJawaban, [
            'nilai' => $nilaiAkhir
        ]);

        return redirect()->back()->with(
            'success',
            'Nilai berhasil dikoreksi'
        );
    }
}
