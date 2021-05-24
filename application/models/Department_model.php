<?php
class Department_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
        $this->load->model("user_model");
    }

    public function getListDepartment() {
        // RETURN ARRAY

        $query = $this->db->get("department");
        return $query->result_array();
    }

    public function getListDepartmentOrderById() {
        $query = $this->db->select("*")->from("department")->order_by("id","ASC")->get();
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

    public function getNameHeadOfDepartment($departmentId) {
        return $this->user_model->getFullNameByUserId($this->user_model->getUserIdHeadOfDepartment($departmentId));
    }

    public function addNewDepartment($data) {
        $this->db->insert("department", $data);

        return $this->db->insert_id();
    }
}