<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->helper('auth');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
    public function login()
    {
        if ($this->input->post()) {
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            $user = $this->User_model->login($login, $password);

            if ($user) {
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('login', $user->login);
                $this->session->set_userdata('userstatus', $user->userstatus);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('phone', $user->phone);

                switch ($user->userstatus) {
                    case 'admin': redirect('admin'); break;
                    case 'rector': redirect('rector'); break;
                    case 'conseliary': redirect('conseliary'); break;
                    case 'rtalim': redirect('r_talim'); break;
                    case 'rkadrho': redirect('r_kadrho'); break;
                    case 'dekan': redirect('dekan'); break;
                    default: redirect('user'); break;
                }
            } else {
                echo "Noto'g'ri login yoki parol!";
            }
        }

        $this->load->view('auth/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
