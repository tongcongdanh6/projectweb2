<?php
class Register_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function addNewUser($user = NULL) {
        if(!$user) {
            return false;
        }
        
        // Check email có tồn tại hay chưa
        $query = $this->db->get_where('users', array('email' => $user['email']));
        if(count($query->result()) > 0) {
            // Có thì return error code -1
            return -1;
        }
        else {
            $this->db->insert("users",$user);
            return true;
        }
    }   
}