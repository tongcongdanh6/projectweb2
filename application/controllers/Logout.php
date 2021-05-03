<?php
class Logout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
    }

    public function index()
    {
        if ($this->session->has_userdata('logged_in')) {
            $keys = [
                'email',
                'logged_in'
            ];
            $this->session->unset_userdata($keys);
            redirect("login");
        }
    }
}
