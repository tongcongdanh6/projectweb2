<?php
class Department_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function getListDepartment() {
        // RETURN ARRAY

        $query = $this->db->get("department");
        return $query->result_array();
    }
}