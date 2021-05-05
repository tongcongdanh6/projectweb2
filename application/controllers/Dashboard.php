<?php
class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("department_model");
        $this->load->model("task_model");
        // Kiểm tra đăng nhập
        if (!$this->session->has_userdata('logged_in')) {
            redirect("login");
        }
    }

    public function index() {
        // Bảng quản trị cho ADMIN
        if(intval($this->session->userdata("role")) === 1) {
            $department_data = $this->department_model->getListDepartment();

            // Lấy dữ liệu tasks theo từng phòng
            $tasks_data = [];
            foreach($department_data as $d) {
                $tasks_data[$d['slug']] = $this->task_model->getTasksByDepartment($d['slug']);
            }

            $data = [
                'pageTitle' => 'Bảng điều khiển chung',
                'subview' => 'dashboard/admindashboard',
                'department_data' => $department_data,
                'tasks_data' => $tasks_data
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