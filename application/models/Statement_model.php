<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
    class Statement_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        // insert bayonot
        public function insert_statement($data) {
            $this->db->insert('statements', $data);
            return $this->db->insert_id();
        }

        public function get_all_statements() {
            $query = $this->db->get('statements');
            return $query->result();
        }

        public function get_statement_by_id($id)
        {
            $query = $this->db->get_where('statements', array('id' => $id));
            return $query->row();  
        }
        #delete bayonot
        public function delete_statement($id) {
            $this->db->delete('statements', array('id' => $id));
        }

        // update bayonot
        public function update_statement($id, $data) {
            $this->db->where('id', $id);
            $this->db->update('statements', $data);
        }

        public function getUserStatement($sender_login)
        {
            return $this->db->where('sender_login', $sender_login)
                            ->order_by('created_at', 'DESC')
                            ->get('statements')
                            ->result();
        }


    }

    

?>