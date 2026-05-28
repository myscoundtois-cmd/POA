<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DataUserModel;

class ProfileController extends BaseController
{
    public function edit()
    {
        $id_user = session()->get('id_user');

        // =========================
        // MODEL
        // =========================

        $usersModel = new UsersModel();
        $dataUserModel = new DataUserModel();

        // =========================
        // DATA USERS
        // =========================

        $usersData = [
            'email' => $this->request->getPost('email'),
        ];

        // =========================
        // DATA PROFILE
        // =========================

        $profileData = [
            'nis'             => $this->request->getPost('nis'),
            'nama'            => $this->request->getPost('nama'),
            'alamat'          => $this->request->getPost('alamat'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'tgl_lahir'       => $this->request->getPost('tgl_lahir'),
            'kelas'           => $this->request->getPost('kelas'),
        ];

        // =========================
        // UPLOAD FOTO
        // =========================

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            // validasi gambar
            $allowedType = [
                'image/png',
                'image/jpg',
                'image/jpeg',
                'image/webp'
            ];

            if (in_array($file->getMimeType(), $allowedType)) {

                // generate nama baru
                $newName = $file->getRandomName();

                // upload file
                $file->move('uploads', $newName);

                // simpan ke database
                $profileData['foto'] = $newName;

                // hapus foto lama
                $oldPhoto = session()->get('foto');

                if (
                    $oldPhoto &&
                    file_exists('uploads/' . $oldPhoto)
                ) {
                    unlink('uploads/' . $oldPhoto);
                }
            } else {

                return redirect()
                    ->back()
                    ->with('error', 'Format foto tidak didukung');
            }
        }

        // =========================
        // UPDATE USERS
        // =========================

        $usersModel
            ->where('id_user', $id_user)
            ->set($usersData)
            ->update();

        // =========================
        // UPDATE DATA USER
        // =========================

        $dataUserModel
            ->where('id_user', $id_user)
            ->set($profileData)
            ->update();

        // =========================
        // UPDATE SESSION
        // =========================

        session()->set(array_merge(
            $usersData,
            $profileData
        ));

        // =========================
        // REDIRECT
        // =========================

        return redirect()
            ->back()
            ->with('success', 'Profile berhasil diupdate');
    }

    public function editpas()
    {
        // =========================
        // MODEL
        // =========================

        $usersModel = new UsersModel();

        // =========================
        // SESSION USER
        // =========================

        $id_user = session()->get('id_user');

        // =========================
        // INPUT
        // =========================

        $newPassword = trim(
            $this->request->getPost('new_password')
        );

        $confirmPassword = trim(
            $this->request->getPost('confirm_password')
        );

        // =========================
        // VALIDASI INPUT
        // =========================

        if (
            empty($newPassword) ||
            empty($confirmPassword)
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Semua field wajib diisi'
                );
        }

        // =========================
        // KONFIRMASI PASSWORD
        // =========================

        if ($newPassword !== $confirmPassword) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Konfirmasi password tidak cocok'
                );
        }

        // =========================
        // VALIDASI PANJANG PASSWORD
        // =========================

        if (strlen($newPassword) < 6) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Password minimal 6 karakter'
                );
        }

        // =========================
        // HASH PASSWORD
        // =========================

        $hashPassword = password_hash(
            $newPassword,
            PASSWORD_DEFAULT
        );

        // =========================
        // UPDATE DATABASE
        // =========================

        $update = $usersModel
            ->where('id_user', $id_user)
            ->set([

                'password'      => $newPassword,
                'password_hash' => $hashPassword

            ])
            ->update();

        // =========================
        // GAGAL UPDATE
        // =========================

        if (!$update) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Password gagal diupdate'
                );
        }

        // =========================
        // UPDATE SESSION
        // =========================

        session()->set([
            'password' => $newPassword
        ]);

        // =========================
        // SUCCESS
        // =========================

        return redirect()
            ->back()
            ->with(
                'success',
                'Password berhasil diupdate'
            );
    }
}
