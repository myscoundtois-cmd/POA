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
        $model = new DataUserModel();

        // $data['siswa_all'] = $model->findAll();

        $data['kelas'] = $model
            ->select('kelas, COUNT(*) as jumlah_siswa')
            ->join('users', 'users.id_user = data_user.id_user')
            ->where('users.role', 'murid')
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
            ->select('users.id_user, data_user.id_dataUser, users.email, users.role,
              data_user.nama, data_user.nis, data_user.jenis_kelamin,
              data_user.alamat, data_user.tgl_lahir, data_user.kelas, data_user.foto')
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

    public function edit_siswa()
    {
        $userModel = new UsersModel();
        $dataUserModel = new DataUserModel();

        $id_user = $this->request->getPost('id_dataUser');

        // ambil data dari form
        $dataUser = [
            'nama'          => $this->request->getPost('nama'),
            'nis'           => $this->request->getPost('nis'),
            'kelas'         => $this->request->getPost('kelas'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'email'         => $this->request->getPost('email'),
            'alamat'        => $this->request->getPost('alamat'),
        ];

        // =========================
        // CEK FOTO (opsional)
        // =========================
        $foto = $this->request->getFile('foto');

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {

            $newName = $foto->getRandomName();
            $foto->move('uploads/foto', $newName);

            $dataUser['foto'] = $newName;
        }

        // =========================
        // UPDATE users (email kalau perlu)
        // =========================
        $userModel->update($id_user, [
            'email' => $dataUser['email']
        ]);

        // =========================
        // UPDATE data_user
        // =========================
        $dataUserModel
            ->where('id_dataUser', $id_user)
            ->set($dataUser)
            ->update();

        return redirect()->back()->with('success', 'Data siswa berhasil diupdate');
    }

    public function delete_siswa($id_dataUser)
    {
        $userModel = new UsersModel();
        $dataUserModel = new DataUserModel();

        $dataUser = $dataUserModel->find($id_dataUser);

        if ($dataUser) {
            $dataUserModel->delete($id_dataUser);
            $userModel->delete($dataUser['id_user']);
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function tambah_siswa()
    {
        $userModel = new UsersModel();
        $dataUserModel = new DataUserModel();

        // =========================
        // AMBIL INPUT FORM
        // =========================
        $nama   = $this->request->getPost('nama');
        $nis    = $this->request->getPost('nis');
        $kelas  = $this->request->getPost('kelas');
        $jk     = $this->request->getPost('jenis_kelamin');
        $alamat = $this->request->getPost('alamat');
        $email  = $this->request->getPost('email');
        $pass   = $this->request->getPost('password');

        // =========================
        // SIMPAN USER (LOGIN)
        // =========================
        $userModel->insert([
            'email' => $email,
            'password' => $pass,
            'password_hash' => password_hash($pass, PASSWORD_DEFAULT),
            'role' => 'murid'
        ]);

        $id_user = $userModel->insertID();

        // =========================
        // UPLOAD FOTO
        // =========================
        $foto = $this->request->getFile('foto');
        $namaFoto = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/foto', $namaFoto);
        }

        // =========================
        // SIMPAN DATA SISWA
        // =========================
        $dataUserModel->insert([
            'id_user'       => $id_user,
            'email'         => $email,
            'nama'          => $nama,
            'nis'           => $nis,
            'kelas'         => $kelas,
            'jenis_kelamin' => $jk,
            'alamat'        => $alamat,
            'foto'          => $namaFoto
        ]);

        return redirect()->back()->with('success', 'Siswa berhasil ditambahkan');
    }
}
