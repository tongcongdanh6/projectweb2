<?php
class Register extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->library("encryption");
    }

    public function index() {
        $this->load->view("register");
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
            $key = bin2hex($this->encryption->create_key(16));
            $config['encryption_key'] = hex2bin($key);
            
            $data = [
                $this->input->post("fullname", TRUE), // TRUE là XSS filter 
                $this->input->post("email", TRUE)
            ];
        }
           
    }
}