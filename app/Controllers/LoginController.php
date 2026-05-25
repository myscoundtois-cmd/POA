<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($user) {
            echo "Login Berhasil";
        } else {
            echo "email atau Password salah";
        }
    }

    public function regist()
    {
        $model = new UserModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'password_hash' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role' => $this->request->getPost('role')
        ];

        $model->save($data);

        return redirect()->to('/');
    }
}
