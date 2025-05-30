<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rector extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Application_model');
        $this->load->model('Conseliary_model');
        $this->load->model('User_model');
        $this->load->model('Statement_model');
        // Form validationni qo'shish
        $this->load->library('form_validation');
       
    }
    
    public function index() {
        $admin_id = $this->session->userdata('user_id');
        $data['admin'] = $this->User_model->get_admin_by_id($admin_id);
        $data['admin_info'] = $this->User_model->get_user_department($admin_id);
        $this->load->view('departments/rector', $data);
    }


    // Arizani ko‘rish
    public function application() {
        $data['applications'] = $this->Application_model->get_applications();
        $this->load->view('application_list', $data);
    }

    // Arizani boshqa bo‘limga yuborish
    public function forward($id) {
        $department_id = $this->input->post('department_id');
        $this->Application_model->forward_application($id, $department_id);
        redirect('rector');
    }

    // Arizani yangilash
    public function update_application($id) {
        $this->load->model('Conseliary_model');
        $data['application'] = $this->Conseliary_model->get_application_by_id($id);
    
        if (!$data['application']) {
            show_404(); // Agar ariza topilmasa 404 xatolik qaytarish
        }
    
       
        
        // Validation qo'shish
        $this->form_validation->set_rules('receiver', 'Receiver', 'required');
        $this->form_validation->set_rules('sender', 'Sender', 'required');
        $this->form_validation->set_rules('faculty', 'Faculty', 'required');
        $this->form_validation->set_rules('guruh', 'Guruh', 'required');
        $this->form_validation->set_rules('fio', 'FIO', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('application_text', 'Application Text', 'required');
    
        // Formni tekshirish
        if ($this->form_validation->run() == FALSE) {
            // Agar formda xatolik bo'lsa, formni qayta ko'rsatish
            $this->load->view('admin/update_application', $data);
        } else {
            // Formda hech qanday xatolik yo'q, yangilash jarayonini amalga oshirish
            $update_data = array(
                'receiver' => $this->input->post('receiver'),
                'sender' => $this->input->post('sender'),
                'faculty' => $this->input->post('faculty'),
                'guruh' => $this->input->post('guruh'),
                'fio' => $this->input->post('fio'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'application_text' => $this->input->post('application_text'),
            );
    
            // Application modelini chaqirib, ma'lumotni yangilash
            $this->Application_model->update_application($id, $update_data);
    
            // Yangilanish muvaffaqiyatli bo'lsa, foydalanuvchini ro'yxatga qaytarish
            $this->session->set_flashdata('success', 'Ariza muvaffaqiyatli yangilandi.');
            redirect('conseliary/application');  // Arizalar ro'yxatiga qaytish
        }
    }

    public function profile()
    {
        $this->load->model('User_model'); 
        $admin_id = $this->session->userdata('user_id'); // Sessiya orqali foydalanuvchi ID sini olish    
        // Adminni ma'lumotlari
        $data['admin'] = $this->User_model->get_admin_by_id($admin_id);
        $data['admin_info'] = $this->User_model->get_user_department($admin_id);
        
        if ($data['admin']) {
            $this->load->view('departments/profile', $data);
        } else {
            show_error('Admin ma\'lumotlari topilmadi!');
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
                $this->session->set_flashdata('success', 'Profile updated.');
            } else {
                $this->session->set_flashdata('error', 'Error at saved date.');
            }
        } else {
            $this->session->set_flashdata('info', 'Don\'nt update.');
        }

        redirect('departments/profile');
    }

    public function statement() {
        $data['statements'] = $this->Statement_model->get_all_statements();
        $this->load->view('statement_list', $data); // Bayonotlar ro'yxatini ko'rsatish
    }

    public function update_statement($id) {
        $this->load->model('Statement_model');
        $data['statements'] = $this->Statement_model->get_statement_by_id($id);
    
        if (!$data['statements']) {
            show_404(); // Agar ariza topilmasa 404 xatolik qaytarish
        }
    
        // Form validationni qo'shish
        $this->load->library('form_validation');
        
        // Validation qo'shish
        $this->form_validation->set_rules('receiver', 'Receiver', 'required');
        $this->form_validation->set_rules('sender', 'Sender', 'required');
        $this->form_validation->set_rules('faculty', 'Faculty', 'required');
        $this->form_validation->set_rules('guruh', 'Guruh', 'required');
        $this->form_validation->set_rules('fio', 'FIO', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('statement_text', 'Application Text', 'required');
    
        // Formni tekshirish
        if ($this->form_validation->run() == FALSE) {
            // Agar formda xatolik bo'lsa, formni qayta ko'rsatish
            $this->load->view('update_statement', $data);
        } else {
            // Formda hech qanday xatolik yo'q, yangilash jarayonini amalga oshirish
            $update_data = array(
                'receiver' => $this->input->post('receiver'),
                'sender_login' => $this->input->post('sender_login'),
                'sender_name' => $this->input->post('sender_name'),
                'faculty' => $this->input->post('faculty'),
                'guruh' => $this->input->post('guruh'),
                'phone' => $this->input->post('phone'),
                'statement_text' => $this->input->post('statement_text'),
            );
    
            // Application modelini chaqirib, ma'lumotni yangilash
            $this->Statement_model->update_statement($id, $update_data);
    
            // Yangilanish muvaffaqiyatli bo'lsa, foydalanuvchini ro'yxatga qaytarish
            $this->session->set_flashdata('success', 'Ariza muvaffaqiyatli yangilandi.');
            redirect('rector/statement');  // Arizalar ro'yxatiga qaytish
        }
    }

    public function delete_statement($id)
    {
        $this->Statement_model->delete_statement($id);  // Foydalanuvchini o‘chirish
        redirect('rector/statement');  // O‘chirilganidan so‘ng ro‘yxatga qaytish
    }
}
