<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conseliary_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_applications() {
        $query = $this->db->get('applications');
        return $query->result();
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

    public function get_application_by_id($id)
    {
        $query = $this->db->get_where('applications', array('id' => $id));
        return $query->row();
    }

    // insert ariza
    public function insert_application($data) {
        return $this->db->insert('applications', $data);
    }
}

?>