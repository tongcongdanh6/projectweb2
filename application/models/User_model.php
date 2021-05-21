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
            // ->where("id <>".intval($currentUserId))
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

    public function getFullNameByEmail($email) {
        if(!$email) return "";

        $query = $this->db->select("fullname")->from("users")->where("email", $email)->get();

        return $query->row_array()['fullname'];
    }
    
    public function getFullNameByUserId($uid) {
        if(!$uid) return 0;

        $query = $this->db->select("fullname")->from("users")->where("id", intval($uid))->get();

        return $query->row_array()['fullname'];
    }
    
    public function getListStaffExceptUserId($uid) {
        if(!$uid) return "";

        $staffByDepartment = $this->getStaffListByDepartment($this->session->userdata("department"));
        
        $result = array_filter($staffByDepartment, function($v, $k) {
            return $v["id"] != $this->session->userdata("id");
        }, ARRAY_FILTER_USE_BOTH);

        // $query = $this->db->select("id, fullname")->where("id <>".$this->session->userdata("id"))->get();

        return $result;
    }

    public function getDepartmentIdByUserId($uid) {
        if(!$uid) return 0;
        $query = $this->db->select("department")->from("users")->where("id", $uid)->get();

        return $query->row_array()["department"];
    }
    
}