<?php
class User_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function getStaffList() {
        // RETURN ARRAY
        $query = $this->db->get("users");
        return $query->result_array();
    }
}