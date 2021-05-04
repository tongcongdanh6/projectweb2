<?php
class Register extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->library("encryption");
        $this->load->model("register_model");
        $this->load->model("department_model");
    }

    public function index() {
        $data = [
            "department_list" => $this->department_model->getListDepartment()
        ];
        $this->load->view("register", $data);
    }

    public function doRegister() {
        // Kiểm tra thông tin nhập
        $rules = [
            [
                'field' => 'fullname',
                'label' => 'Họ tên',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Họ tên không được rỗng',
                ]
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'Email không được rỗng',
                    'valid_email' => 'Vui lòng điền email hợp lệ'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Mật khẩu',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mật khẩu không được rỗng'
                ]
            ]
        ];

        $this->form_validation->set_rules($rules);

        if(!$this->form_validation->run()) {
            $this->load->view("register");
        }
        else {
             // Dữ liệu hợp lệ thì thêm vào hệ thống
             // Mã hóa password
            $encrypted_password = $this->encryption->encrypt($this->input->post("password", TRUE));

            $data = [
                'email' => $this->input->post("email", TRUE),
                'password' => $encrypted_password,
                'fullname' => $this->input->post("fullname", TRUE),
                'department' => $this->department_model->getIdDepartment($this->input->post("staff_department")),
                'created_at' => date("Y-m-d h:i:sa")
            ];

            
            if($this->register_model->addNewUser($data) === true) {
                $this->load->view("register_successfully");
            }
            else if($this->register_model->addNewUser($data) === -1) {
                $this->load->view("duplicate_email");
            }
            else {
                $this->load->view("register_fail");
            }

        }
           
    }
}