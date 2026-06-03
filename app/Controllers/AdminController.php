<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;
use App\Models\MapelModel;
use App\Models\MateriModel;

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
