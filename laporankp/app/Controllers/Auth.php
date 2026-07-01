<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, langsung lempar ke dashboard kriteria
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('kriteria'));
        }
        return view('login');
    }

    public function login_action()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            // Verifikasi password hash
            //if (password_verify($password, $user['password'])) {
                // GANTI DENGAN KODE INI:
            if (md5($password) === $user['password']) {
                // Set data session penting termasuk ROLE
                $session->set([
                    'id_user'   => $user['id'],
                    'nama'      => $user['nama'],
                    'username'  => $user['username'],
                    'role'      => $user['role'], // 'admin' atau 'user'
                    'logged_in' => true
                ]);

                return redirect()->to(base_url('kriteria'));
            } else {
                $session->setFlashdata('error', 'Password yang Anda masukkan salah.');
                return redirect()->to(base_url('login'));
            }
        } else {
            $session->setFlashdata('error', 'Username tidak terdaftar.');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}