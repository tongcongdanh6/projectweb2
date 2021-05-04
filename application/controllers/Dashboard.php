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
        // Bảng quản trị cho ADMIN
        if(intval($this->session->userdata("role")) === 1) {
            $data = [
                'pageTitle' => 'Bảng điều khiển chung',
                'subview' => 'dashboard/index'
            ];
            $this->load->view("layout1", $data);
        }
        // Bảng quản trị cho User
        else {
            $data = [
                'pageTitle' => 'Bảng điều khiển chung',
                'subview' => 'dashboard/userdashboard'
            ];
            $this->load->view("layout1", $data);
        }
    }

    public function test() {
        echo "test";
    }
}