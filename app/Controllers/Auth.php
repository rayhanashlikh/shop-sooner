<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $model;

    public function __construct()
    {
        helper('view_helper');
        $this->model = new UserModel();
    }

    public function login()
    {
        return blade('auth.login');
    }

    public function signIn()
    {
        $session = session();
        $model = $this->model;
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        
        if ($data) {
            $user_id = $data['id'];
            $nama = $data['nama'];
            $pass = $data['password'];
            $verify = password_verify($password, $pass);
            // dd($verify);
            if ($verify) {
                $ses_data = [
                    'user_id' => $user_id,
                    'nama' => $nama,
                    'user_logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Username atau Password salah!');
                return redirect()->to('login')->withInput();
            }
        } else {
            $session->setFlashdata('msg', 'Username atau Password salah!');
                return redirect()->to('login')->withInput();
        }
    }

    public function register()
    {
        return blade('auth.register');
    }

    public function signUp()
    {
        $session = session();
        $validation = Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required|is_unique[users.id, users.username]',
            'password' => 'required|min_length[6]'
        ]);
        $isValid = $validation->withRequest($this->request)->run();
        // dd(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT));

        if ($isValid) {
            $this->model->insert([
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ]);

            return redirect('login');
        } else {
            // $validate = $validation;
            $cek = $session->setFlashdata('msg', 'cek');

            return redirect()->to('register')->with('cek', $cek)->withInput();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        
        return redirect()->to('/');
    }
}
