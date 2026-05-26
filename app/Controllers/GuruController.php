<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;

class GuruController extends BaseController
{
    public function index()
    {
        // cek login
        if (!session()->get('logged_in')) {

            return redirect()->to('/');
        }

        // cek role
        if (session()->get('role') != 'guru') {

            return redirect()->to('/');
        }

        return view('content/dashboard');
    }
}
