<?php
class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("department_model");
        $this->load->model("user_model");
    }

    public function index() {
        $data = [
            'pageTitle' => 'Danh sách nhân viên',
            'subview' => 'users/index',
            'staffList' =>  $this->user_model->getStaffList()
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