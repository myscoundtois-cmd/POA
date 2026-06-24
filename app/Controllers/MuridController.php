<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;
use App\Models\PgEssayModel;
use App\Models\JawabanModel;
use App\Models\MapelModel;
use App\Models\MateriModel;
use App\Models\TugasUjiModel;

class MuridController extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        if (session()->get('role') != 'murid') {
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

        $data['mapel'] = $mapelModel
            ->where('kelas', session()->get('kelas'))
            ->findAll();

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

        $data['jawabanSiswa'] = $jawabanModel
            ->where('id_user', session('id_user'))
            ->orderBy('id_mapel', 'ASC')
            ->orderBy('pertemuan', 'ASC')
            ->findAll();

        $data['lihat_nilai'] = $model
            ->select('
        data_user.*,
        jawabansiswa.nilai,
        jawabansiswa.pertemuan,
        mapel.nama_mapel,
        mapel.kelas as kelas_mapel
    ')
            ->join('jawabansiswa', 'jawabansiswa.nis = data_user.nis', 'left')
            ->join('mapel', 'mapel.id_mapel = jawabansiswa.id_mapel', 'left')
            ->where('data_user.nis', session('nis'))
            ->where('data_user.nama', session('nama'))
            ->findAll();

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

    public function simpanJawaban()
    {
        $jawabanModel = new JawabanModel();
        $soalModel    = new PgEssayModel();

        $jawabanPG    = $this->request->getPost('jawaban');
        $jawabanEssay = $this->request->getPost('jawabanEssay');

        // Jika tidak ada jawaban sama sekali
        if (empty($jawabanPG) && empty($jawabanEssay)) {
            return redirect()->back()
                ->with('error', 'Tidak ada jawaban yang dikirim.');
        }

        $id_user    = session()->get('id_user');
        $nama_siswa = session()->get('nama');
        $id_mapel   = session()->get('id_mapel');

        $jumlahBenar = 0;
        $totalSoal   = 0;
        $semuaJawaban = [];

        /*
    |--------------------------------------------------------------------------
    | PROSES PILIHAN GANDA
    |--------------------------------------------------------------------------
    */
        if (!empty($jawabanPG)) {

            foreach ($jawabanPG as $id_soal => $isi_jawaban) {

                $soal = $soalModel->find($id_soal);

                if (!$soal) {
                    continue;
                }

                $totalSoal++;

                $semuaJawaban[] = $id_soal . '.' . trim($isi_jawaban);

                $kunci = strtoupper(trim($soal['kunci']));

                if (strtoupper(trim($isi_jawaban)) == $kunci) {
                    $jumlahBenar++;
                }
            }
        }

        /*
    |--------------------------------------------------------------------------
    | PROSES ESSAY
    |--------------------------------------------------------------------------
    */
        if (!empty($jawabanEssay)) {

            foreach ($jawabanEssay as $id_soal => $isi_jawaban) {

                if (trim($isi_jawaban) == '') {
                    continue;
                }

                $semuaJawaban[] =
                    $id_soal . '.[' . trim($isi_jawaban) . ']';
            }
        }

        /*
    |--------------------------------------------------------------------------
    | HITUNG NILAI PG
    |--------------------------------------------------------------------------
    */
        $nilai = 0;

        if ($totalSoal > 0) {
            $nilai = round(($jumlahBenar / $totalSoal) * 100);
        }

        /*
    |--------------------------------------------------------------------------
    | GABUNGKAN JAWABAN
    |--------------------------------------------------------------------------
    */
        $jawabanGabung = implode(',', $semuaJawaban);

        /*
    |--------------------------------------------------------------------------
    | AMBIL PERTEMUAN
    |--------------------------------------------------------------------------
    */
        if (!empty($jawabanPG)) {

            $idSoalPertama = array_key_first($jawabanPG);
        } else {

            $idSoalPertama = array_key_first($jawabanEssay);
        }

        $soalPertama = $soalModel->find($idSoalPertama);

        if (!$soalPertama) {
            return redirect()->back()
                ->with('error', 'Data soal tidak ditemukan.');
        }

        $nis = session('nis');
        /*
    |--------------------------------------------------------------------------
    | SIMPAN KE DATABASE
    |--------------------------------------------------------------------------
    */
        $jawabanModel->insert([
            'pertemuan'  => $soalPertama['pertemuan'],
            'id_mapel'   => $id_mapel,
            'id_user'    => $id_user,
            'nama_siswa' => $nama_siswa,
            'nis' => $nis,
            'jawaban'    => $jawabanGabung,
            'nilai'      => $nilai,
            'create_at'  => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()
            ->with('success', 'Jawaban berhasil disimpan.');
    }
}
