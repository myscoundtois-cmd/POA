<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $model = new UsersModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // cari user berdasarkan email
        $user = $model->where('email', $email)->first();

        // cek user
        if ($user) {

            // verifikasi password hash
            if (password_verify($password, $user['password_hash'])) {

                // simpan session
                session()->set([
                    'id_user'       => $user['id_user'],
                    'email'    => $user['email'],
                    'role'     => $user['role'],
                    'logged_in' => true
                ]);

                // redirect berdasarkan role
                switch ($user['role']) {

                    case 'admin':
                        return redirect()->to('/admin/dashboard');

                    case 'guru':
                        return redirect()->to('/guru/dashboard');

                    case 'murid':
                        return redirect()->to('/murid/dashboard');

                    case 'wali':
                        return redirect()->to('/wali/dashboard');

                    default:
                        return redirect()->back()->with('error', 'Role tidak dikenali');
                }
            } else {

                return redirect()->back()->with('error', 'Password salah');
            }
        } else {

            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
    public function regist()
    {
        $model = new UsersModel();
        $modelData = new DataUserModel();

        // upload foto
        $foto = $this->request->getFile('foto');

        $namaFoto = $foto->getRandomName();

        $foto->move('uploads', $namaFoto);

        // data tabel users
        $data1 = [

            'email' => $this->request->getPost('email'),

            'password' => $this->request->getPost('password'),
            'password_hash' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),

            'role' => $this->request->getPost('role'),
        ];

        // simpan ke users
        $model->save($data1);

        // ambil id user terakhir
        $id_user = $model->getInsertID();

        // data tabel data_users
        $data2 = [

            'nama' => $this->request->getPost('nama'),

            'email' => $this->request->getPost('email'),

            'foto' => $namaFoto,

            'id_user' => $id_user
        ];

        // simpan data detail user
        $modelData->save($data2);

        return redirect()->to('/');
    }
}
