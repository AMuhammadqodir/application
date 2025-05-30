<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

  
    public function get_applications() {
        $query = $this->db->get('applications');
        return $query->result();
    }

    
    public function get_application($id) {
        return $this->db->get_where('applications', array('id' => $id))->row();
    }

    public function get_application_by_id($id)
    {
        $query = $this->db->get_where('applications', array('id' => $id));
        return $query->row();
    }

    public function getUserApplication($sender_login)
        {
            return $this->db->where('sender_login', $sender_login)
                            ->order_by('created_at', 'DESC')
                            ->get('applications')
                            ->result();
        }

    // #insert ariza
    public function insert_application($data) {
        return $this->db->insert('applications', $data);
    }

    public function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('applications', array('status' => $status));
    }

    #update ariza
    public function update_application($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('applications', $data);
    }

   
    
    public function delete_application($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('applications');
    }

    
}
