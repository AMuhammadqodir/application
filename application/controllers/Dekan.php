<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dekan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Application_model');
        $this->load->model('Conseliary_model');
        $this->load->model('User_model');
        $this->load->model('Statement_model');
        $this->load->library('form_validation');
       
    }
    
    public function index() {
        $admin_id = $this->session->userdata('user_id');
        $data['admin'] = $this->User_model->get_admin_by_id($admin_id);
        $data['admin_info'] = $this->User_model->get_user_department($admin_id);
        $this->load->view('departments/dekan', $data);
    }

    public function application() {
        $data['applications'] = $this->Application_model->get_applications();
        $this->load->view('application_list', $data);
    }

    public function forward($id) {
        $department_id = $this->input->post('department_id');
        $this->Application_model->forward_application($id, $department_id);
        redirect('rector');
    }

    public function submit() {
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

    public function update_application($id) {
        $this->load->model('Conseliary_model');
        $data['application'] = $this->Conseliary_model->get_application_by_id($id);
    
        if (!$data['application']) {
            show_404();
        }

        $this->form_validation->set_rules('receiver', 'Receiver', 'required');
        $this->form_validation->set_rules('sender', 'Sender', 'required');
        $this->form_validation->set_rules('faculty', 'Faculty', 'required');
        $this->form_validation->set_rules('guruh', 'Guruh', 'required');
        $this->form_validation->set_rules('fio', 'FIO', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('application_text', 'Application Text', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/update_application', $data);
        } else {
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
    
            $this->Application_model->update_application($id, $update_data);
    
            $this->session->set_flashdata('success', 'Ariza muvaffaqiyatli yangilandi.');
            redirect('dekan/application');
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
            show_error('Admin ma\'lumotlari topilmadi!');
        } 
    }


    public function profile()
    {
        $this->load->model('User_model'); 
        $admin_id = $this->session->userdata('user_id');
        $data['admin'] = $this->User_model->get_admin_by_id($admin_id);
        $data['admin_info'] = $this->User_model->get_user_department($admin_id);
        
        if ($data['admin']) {
            $this->load->view('admin/profile', $data);
        } else {
            show_error('Profile information not found!');
        } 
    }


    public function update_profile()
    {
        $this->load->model('User_model');
    
        $admin_id = $this->session->userdata('user_id');
    
        if (!$admin_id) {
            show_error('Error', 500);
            return;
        }
        $pictures = '';
        if (isset($_FILES['pictures']) && $_FILES['pictures']['error'] == 0) {
            $config['upload_path']   = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 5120; // 5MB
            $config['file_name']     = uniqid('img_');
        
            $this->load->library('upload');
            $this->upload->initialize($config);
        
            if (!$this->upload->do_upload('pictures')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('admin/update_profile');
                return;
            } else {
                $upload_data = $this->upload->data();
                $pictures = 'assets/uploads/' . $upload_data['file_name'];

                $old_picture = $this->User_model->get_old_picture($admin_id);
                if ($old_picture && file_exists(FCPATH . $old_picture) && $old_picture != 'assets/uploads/default.png') {
                    unlink(FCPATH . $old_picture);
                }
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
                $this->session->set_flashdata('error', 'An error occurred while updating.');
            }
        } else {
            $this->session->set_flashdata('info', 'No changes were made.');
        }

        redirect('admin');
    }

    public function statement() {
        $data['statements'] = $this->Statement_model->get_all_statements();
        $this->load->view('statement_list', $data); 
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
                'statement_text' => $this->input->post('statement_text'),
                'created_at' => date('Y-m-d H:i:s')
            );
            log_message('debug', 'Bazaga yuborilayotgan ma\'lumotlar: ' . print_r($data, true));

            $insert_id = $this->Statement_model->insert_statement($data);

            if ($insert_id) {
                $this->session->set_flashdata('success', 'Bayonot muvaffaqiyatli yuklandi!');
                redirect('dekan/statement');
            } else {
                log_message('error', 'Ma\'lumotni bazaga saqlashda xatolik yuz berdi.');
                $this->session->set_flashdata('error', 'Ma\'lumotni bazaga saqlashda xatolik yuz berdi.');
                redirect('dekan');
            }
        } else {
            $this->load->view('statement_form', $data);
        }
    }

    public function update_statement($id) {
        $this->load->model('Statement_model');
        $data['statements'] = $this->Statement_model->get_statement_by_id($id);
    
        if (!$data['statements']) {
            show_404();
        }
    
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('receiver', 'Receiver', 'required');
        $this->form_validation->set_rules('sender', 'Sender', 'required');
        $this->form_validation->set_rules('faculty', 'Faculty', 'required');
        $this->form_validation->set_rules('guruh', 'Guruh', 'required');
        $this->form_validation->set_rules('fio', 'FIO', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('statement_text', 'Application Text', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('update_statement', $data);
        } else {
            $update_data = array(
                'receiver' => $this->input->post('receiver'),
                'sender_login' => $this->input->post('sender_login'),
                'sender_name' => $this->input->post('sender_name'),
                'faculty' => $this->input->post('faculty'),
                'guruh' => $this->input->post('guruh'),
                'phone' => $this->input->post('phone'),
                'statement_text' => $this->input->post('statement_text'),
            );
    
            $this->Statement_model->update_statement($id, $update_data);
    
            $this->session->set_flashdata('success', 'Ariza muvaffaqiyatli yangilandi.');
            redirect('dekan/statement');
        }
    }

    public function delete_statement($id)
    {
        $this->Statement_model->delete_statement($id);
        redirect('dekan/statement');
    }
}
