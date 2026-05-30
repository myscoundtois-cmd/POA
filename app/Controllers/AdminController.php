<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;
use App\Models\MapelModel;

class AdminController extends BaseController
{
    public function index()
    {
        // cek login
        if (!session()->get('logged_in')) {

            return redirect()->to('/');
        }

        // cek role
        if (session()->get('role') != 'admin') {

            return redirect()->to('/');
        }

        $model = new MapelModel();
        $data['mapel'] = $model->findAll();
        $userModel = new UsersModel();

        $data['guru'] = $userModel
            ->select('users.id_user, data_user.nama')
            ->join('data_user', 'data_user.id_user = users.id_user')
            ->where('users.role', 'guru')
            ->findAll();

        return view('content/dashboard', $data);
    }
}
