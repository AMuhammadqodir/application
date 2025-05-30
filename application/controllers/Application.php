<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Application_model');
        $this->load->model('User_model');
        $this->load->helper('auth');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->input->post()) {
            $data = array(
                'receiver' => $this->input->post('receiver'),
                'sender' => $this->input->post('sender'),
                'faculty' => $this->input->post('faculty'),
                'guruh' => $this->input->post('guruh'),
                'fio' => $this->input->post('fio'),
                'phone' => $this->input->post('phone'),
                'application_text' => $this->input->post('application_text')
            );

            $this->Application_model->insert_application($data);
            redirect('application');
        } else {
            $this->load->view('application_form');
        }
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


    // public function success() {
    //     echo "Application submit successfully!";
    // }

    public function delete_application($id)
    {
        $this->Application_model->delete_application($id);
        redirect('application');
    }
}
