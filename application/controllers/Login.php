<?php
class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->library("form_validation");
        if (!$this->session->has_userdata('logged_in')) {
            // echo "Chưa login";
        }
    }

    public function index()
    {
        $this->load->view("login");
        // var_dump($this->session->has_userdata("id"));
    }

    public function dologin()
    {
        // Kiểm tra thông tin nhập
        $rules = [
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

        // Chạy validation
        if (!$this->form_validation->run()) {
            // Nếu không hợp lệ thì load lại login
            $this->load->view("login");
        } else {
            $data = [
                'email' => 'test@gmail.com',
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($data);
            redirect("login");
        }
    }
}
