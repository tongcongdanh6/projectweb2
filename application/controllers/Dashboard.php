<?php
class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        // Kiểm tra đăng nhập
        if (!$this->session->has_userdata('logged_in')) {
            redirect("login");
        }
    }

    public function index() {
        $this->load->view("dashboard");
    }

    public function test() {
        echo "test";
    }
}