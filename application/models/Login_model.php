<?php
class Login_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('encryption');
    }

    public function isMemberExist($user = NULL)
    {
        if (!$user) {
            return false;
        }

        $query = $this->db->get_where('users', array('email' => $user['email']));
        if ($query->num_rows() === 1) {
            // Có thì return true
            return true;
        }
        else {
            return false;
        }
    }

    public function validateUser($user = NULL) {
        if (!$user) {
            return false;
        }
        $query = $this->db->get_where('users', ['email' => $user['email']]);
        if($this->encryption->decrypt($query->row_array()['password']) === $user['password']) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getUserRole($user = NULL) {
        if (!$user) {
            return false;
        }
        $query = $this->db->get_where('users', ['email' => $user['email']]);
        return $query->row_array()['role'];
    }

    public function getUserDepartment($user = NULL) {
        if (!$user) {
            return false;
        }
        $query = $this->db->get_where('users', ['email' => $user['email']]);
        return $query->row_array()['department'];
    }
}
