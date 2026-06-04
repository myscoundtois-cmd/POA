<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;
use App\Models\PgEssayModel;
use App\Models\JawabanModel;


class MuridController extends BaseController
{
    public function index()
    {
        // cek login
        if (!session()->get('logged_in')) {

            return redirect()->to('/');
        }

        // cek role
        if (session()->get('role') != 'murid') {

            return redirect()->to('/');
        }

        return view('content/dashboard');
    }

    public function simpanJawaban()
    {
        $jawabanModel = new JawabanModel();
        $soalModel    = new PgEssayModel();

        $jawaban = $this->request->getPost('jawaban');

        if (empty($jawaban)) {
            return redirect()->back()
                ->with('error', 'Tidak ada jawaban yang dikirim.');
        }

        $id_user    = session()->get('id_user');
        $nama_siswa = session()->get('nama');

        $jumlahBenar = 0;
        $totalSoal   = 0;

        $semuaJawaban = [];

        foreach ($jawaban as $id_soal => $isi_jawaban) {

            $soal = $soalModel->find($id_soal);

            if (!$soal) {
                continue;
            }

            $totalSoal++;

            // simpan format: idsoal.jawaban
            $semuaJawaban[] = $id_soal . '.' . $isi_jawaban;

            // sesuaikan nama field kunci
            $kunci = strtoupper(trim($soal['kunci']));

            if (strtoupper(trim($isi_jawaban)) == $kunci) {
                $jumlahBenar++;
            }
        }

        // nilai akhir
        $nilai = 0;

        if ($totalSoal > 0) {
            $nilai = round(($jumlahBenar / $totalSoal) * 100);
        }

        // gabungkan semua jawaban menjadi satu string
        $jawabanGabung = implode(',', $semuaJawaban);

        // ambil pertemuan dari soal pertama
        $idSoalPertama = array_key_first($jawaban);
        $soalPertama   = $soalModel->find($idSoalPertama);

        $jawabanModel->insert([
            'pertemuan' => $soalPertama['pertemuan'],
            'id_user'   => $id_user,
            'nama_siswa' => $nama_siswa,
            'jawaban'   => $jawabanGabung,
            'nilai'     => $nilai,
            'create_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()
            ->with('success', 'Jawaban berhasil disimpan.');
    }
}
