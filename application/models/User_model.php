<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function register($data)
    {
        return $this->db->insert('users', $data);
    }

    public function login($login, $password)
    {
        $this->db->where('login', $login);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) { 
                return $user;
            }
        }
        return false; 
    }

    public function create_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_all_users_with_status() {
        $this->db->select('users.*, departments.department_name');
        $this->db->from('users');
        $this->db->join('login', 'users.userstatus = login.userstatus');
        $this->db->join('departments', 'login.id = departments.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

  public function get_all_users_with_password() {
        $this->db->select('users.*, user_password.password');
        $this->db->from('users');
        $this->db->join('user_password', 'users.id = user_password.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row();
    }

    public function get_user_by_login($login) {
        $this->db->where('login', $login);
        $query = $this->db->get('users');
        return $query->row();
    }
    
    

    public function get_user_password_by_id($id)
    {
        $query = $this->db->get_where('user_password', array('id' => $id));
        return $query->row();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    
    public function delete_user($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('user_password');
        $this->db->where('id', $id);
        $this->db->delete('users');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_admin()
    {
        return $this->db->get_where('users', ['id' => 1])->row();
    }
    public function get_admin_by_id($id)
    {
        $query = $this->db->get_where('users', ['id' => $id]);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function get_user_department($admin_id) {
        $this->db->select('u.username, d.department_name');
        $this->db->from('users u');
        $this->db->join('login l', 'u.userstatus = l.userstatus');
        $this->db->join('departments d', 'd.id = l.id');
        $this->db->where('u.id', $admin_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    public function update_admin($admin_id, $data)
    {
        $this->db->where('id', $admin_id);
        
        $result = $this->db->update('users', $data);
    
        if (!$result) {
            $error = $this->db->error();
            log_message('error', 'Update failed: ' . $error['message']);
            return false;
        }
        return true;
    }


    public function get_old_picture($admin_id)
    {
        $this->db->select('pictures');
        $this->db->from('users');
        $this->db->where('id', $admin_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result ? $result->pictures : null;
    }

    

}
