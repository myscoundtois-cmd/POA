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

        $data['guru'] = $userModel
            ->select('users.id_user, data_user.nama')
            ->join('data_user', 'data_user.id_user = users.id_user')
            ->where('users.role', 'guru')
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
