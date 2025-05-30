<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Application_model');
        $this->load->model('Conseliary_model');
        $this->load->model('Statement_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('auth');
        
       
    }

    public function index() {
        $admin_id = $this->session->userdata('user_id');
        $data['admin'] = $this->User_model->get_admin_by_id($admin_id);
        $data['admin_info'] = $this->User_model->get_user_department($admin_id);
        $this->load->view('user/dashboard', $data);
    }
    
    public function my_applications()
    {
        $sender_login = $this->session->userdata('login');
        $data['applications'] = $this->Application_model->getUserApplication($sender_login);
        $this->load->view('user/my_applications', $data);
    }
    

    public function submit() {
        $admin_id = $this->session->userdata('user_id'); 
        $data['admin'] = $this->User_model->get_user_by_id($admin_id);
        
        if ($this->input->post()) {
            $data = array(
                'receiver' => $this->input->post('receiver'),
                'sender_login' => $this->input->post('sender_login'),
                'sender_name' => $this->input->post('sender_name'),
                'faculty' => $this->input->post('faculty'),
                'guruh' => $this->input->post('guruh'),
                'phone' => $this->input->post('phone'),
                'app_for' => $this->input->post('app_for'),
                'application_text' => $this->input->post('application_text'),
            );
        
            log_message('debug', 'Bazaga yuborilayotgan ma\'lumotlar: ' . print_r($data, true));
        
            $insert_id = $this->Application_model->insert_application($data);
        
            if ($insert_id) {
                $this->session->set_flashdata('success', 'Ariza muvaffaqiyatli yuklandi!');
                redirect('application/submit');
            } else {
                log_message('error', 'Ma\'lumotni bazaga saqlashda xatolik yuz berdi.');
                $this->session->set_flashdata('error', 'Ma\'lumotni bazaga saqlashda xatolik yuz berdi.');
                redirect('application');
            }
        } else {
            $this->load->view('application_form', $data);
        }
    }
    
    public function my_statements()
    {
        $sender_login = $this->session->userdata('login');
        $data['statements'] = $this->Statement_model->getUserStatement($sender_login);
        $this->load->view('user/my_statements', $data);
    }

    public function submit_statement() {
        $admin_id = $this->session->userdata('user_id');
        $data['admin'] = $this->User_model->get_admin_by_id($admin_id);

        if ($this->input->post()) {
            $data = array(
                'receiver' => $this->input->post('receiver'),
                'sender_login' => $this->input->post('sender_login'),
                'sender_name' => $this->input->post('sender_name'),
                'faculty' => $this->input->post('faculty'),
                'guruh' => $this->input->post('guruh'),
                'phone' => $this->input->post('phone'),
                'stat_for' => $this->input->post('stat_for'),
                'statement_text' => $this->input->post('statement_text'),
                'created_at' => date('Y-m-d H:i:s')
            );
            log_message('debug', 'Bazaga yuborilayotgan ma\'lumotlar: ' . print_r($data, true));

            $insert_id = $this->Statement_model->insert_statement($data);

            if ($insert_id) {
                $this->session->set_flashdata('success', 'Bayonot muvaffaqiyatli yuklandi!');
                redirect('user');
            } else {
                log_message('error', 'Error on save to database.');
                $this->session->set_flashdata('error', 'Error on save to database.');
                redirect('user');
            }
        } else {
            $this->load->view('statement_form', $data);
        }
    }


    public function profile()
    {
        $this->load->model('User_model'); 
        $admin_id = $this->session->userdata('user_id');
        $data['admin'] = $this->User_model->get_admin_by_id($admin_id);
        $data['admin_info'] = $this->User_model->get_user_department($admin_id);
        
        if ($data['admin']) {
            $this->load->view('departments/profile', $data);
        } else {
            show_error('Profile information not found!');
        } 
    }


    public function update_profile()
    {
        $this->load->model('User_model');
    
        $admin_id = $this->session->userdata('user_id');
    
        if (!$admin_id) {
            show_error('Admin ID aniqlanmadi!', 500);
            return;
        }
    
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 5120; // 5MB
        $config['file_name']     = uniqid();
        $this->load->library('upload', $config);
    
        $pictures = '';
    
        if ($_FILES['pictures']['size'] > 0) { 
            if (!$this->upload->do_upload('pictures')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('departments/update_profile');
                return;
            } else {
                $upload_data = $this->upload->data();
                $pictures = 'assets/uploads/' . $upload_data['file_name'];
            }
        }
    
        $new_data = [];
        if ($this->input->post('login')) {
            $new_data['login'] = $this->input->post('login');
        }
        if ($this->input->post('username')) {
            $new_data['username'] = $this->input->post('username');
        }
        if ($this->input->post('phone')) {
            $new_data['phone'] = $this->input->post('phone');
        }
        if ($pictures) {
            $new_data['pictures'] = $pictures;
        }
    
        if (!empty($new_data)) {
            $update_result = $this->User_model->update_admin($admin_id, $new_data);
            if ($update_result) {
                $this->session->set_flashdata('success', 'Profil yangilandi.');
            } else {
                $this->session->set_flashdata('error', 'Error at saved date.');
            }
        } else {
            $this->session->set_flashdata('info', 'Don\'nt update.');
        }

        redirect('user/profile');
    }
}
