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

    public function getStaffListByDepartment($idOrSlug) {
        if(!$idOrSlug) return;
        
        // Lấy current Id để loại trừ ra khỏi list
        $currentUserId = $this->getUserIdByEmail($this->session->userdata('email'));

        if(is_numeric($idOrSlug)) {
            $query = $this->db->select("*")->from("users")
            ->where("department", $idOrSlug)
            ->where("id <>".intval($currentUserId))
            ->get();
        }

        return $query->result_array();
    }

    public function getPositionNameById($id) {
        $query = $this->db->get_where("position", ['id' => $id]);
        return $query->row_array()['name'];
    }

    public function getUserIdByEmail($email) {
        if(!$email) return;

        $query = $this->db->select("id")->from("users")->where("email", $email)->get();

        return $query->row_array()['id'];
    }
}