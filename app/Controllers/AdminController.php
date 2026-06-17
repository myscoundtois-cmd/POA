<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;
use App\Models\MapelModel;
use App\Models\MateriModel;
use App\Models\PgEssayModel;
use App\Models\TugasUjiModel;

class AdminController extends BaseController
{

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        if (session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $mapelModel = new MapelModel();
        $materiModel = new MateriModel();
        $userModel = new UsersModel();
        $pgEssayModel = new PgEssayModel();
        $tugasUjiModel = new TugasUjiModel();
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
}
