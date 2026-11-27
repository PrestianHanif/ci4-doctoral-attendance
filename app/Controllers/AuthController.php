<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AuthController extends BaseController
{
    protected AdminModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    /**
     * Halaman Login Admin Panitia Sidang
     */
    public function login()
    {
        if (session()->get('is_admin_logged_in') || session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Masuk Panel Panitia — Sidang Promosi Doktor UII x KOWPI',
        ];

        return view('auth/login', $data);
    }

    /**
     * Proses Autentikasi Login
     */
    public function submitLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        if (empty($username) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Username dan password wajib diisi.');
        }

        $admin = $this->adminModel->authenticate($username, $password);

        if (!$admin) {
            return redirect()->back()->withInput()->with('error', 'Kredensial salah. Periksa kembali username dan password Anda.');
        }

        // Set session data
        $sessionData = [
            'is_admin_logged_in' => true,
            'isLoggedIn'         => true,
            'admin_id'           => $admin['id'],
            'admin_username'     => $admin['username'],
            'admin_name'         => $admin['full_name'],
            'admin_role'         => $admin['role'],
            'logged_at'          => date('Y-m-d H:i:s'),
        ];
        session()->set($sessionData);

        // Jika ada URL yang sebelumnya ingin diakses
        $intendedUrl = session()->get('intended_url');
        if ($intendedUrl) {
            session()->remove('intended_url');
            return redirect()->to($intendedUrl)->with('success', "Selamat datang, {$admin['full_name']}!");
        }

        return redirect()->to(base_url('dashboard'))->with('success', "Selamat datang, {$admin['full_name']}!");
    }

    /**
     * Logout Sesi Admin
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar dari sesi panel admin.');
    }
}
