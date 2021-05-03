<?php
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        if(!$this->session->has_userdata('logged_in')) {
            // echo "Chưa login";
        }
    }

    public function index() {
        $this->load->view("login");
        // var_dump($this->session->has_userdata("id"));
    }

    public function dologin() {
        $data = [
            'email' => 'test@gmail.com',
            'logged_in' => TRUE
        ];
        $this->session->set_userdata($data);
        redirect("login");
    }
}