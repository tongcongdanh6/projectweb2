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

    public function getIdDepartment($slug = "") {
        if(!$slug) {
            return false;
        }

        $query = $this->db->get_where("department", ['slug' => $slug]);
        return $query->row_array()['id'];
    }

    public function getNameById($id) {
        $query = $this->db->get_where("department", ['id' => $id]);
        return $query->row_array()['name'];
    }
}