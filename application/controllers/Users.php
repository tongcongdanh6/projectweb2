<?php
class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("department_model");
        $this->load->model("user_model");
        
        if(intval($this->session->userdata("role")) !== 1) {
            redirect("dashboard");
        }
    }

    public function index() {
        // Lấy staff list hiển thị view từ trong User Model & Department Model
        $staff_list = [];
        foreach($this->user_model->getStaffList() as $s) {
            array_push($staff_list, [
                'fullname' => $s['fullname'],
                'department_name' => $this->department_model->getNameById(intval($s['department'])),
                'position_name' => $this->user_model->getPositionNameById(intval($s['position'])),
                'email' => $s['email']
            ]);
        }

        $data = [
            'pageTitle' => 'Danh sách nhân viên',
            'subview' => 'users/index',
            'staffList' =>  $staff_list
        ];
        $this->load->view("layout1", $data);
    }

    public function add() {

        $data = [
            'pageTitle' => 'Thêm nhân viên mới',
            'subview' => 'users/add',
            'department_list' => $this->department_model->getListDepartment()
        ];
        $this->load->view("layout1", $data);
    }
}