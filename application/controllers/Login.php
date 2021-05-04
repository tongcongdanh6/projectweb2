<?php
class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->library("form_validation");
        $this->load->library("encryption");
        $this->load->model("login_model");
        if ($this->session->has_userdata('logged_in')) {
            redirect("dashboard");
        }
    }

    public function index()
    {
        $this->load->view("login");
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
            // Hợp lệ thì tiến hành đăng nhập
            $userdata = [
                'email' => $this->input->post("email", TRUE),
                'password' => $this->input->post("password", TRUE)
            ];

            // Kiểm tra user có tồn tại hay không
            if ($this->login_model->isMemberExist($userdata)) {
                // CÓ
                if ($this->login_model->validateUser($userdata) === TRUE) {
                    // Đăng nhập hợp lệ thì set session
                    $session_data = [
                        'email' => $userdata['email'],
                        'logged_in' => TRUE,
                        'role' => $this->login_model->getUserRole($userdata)
                    ];
                    $this->session->set_userdata($session_data);
                    redirect("dashboard");
                } else {
                    // Sai thông tin đăng nhập
                    $this->session->set_flashdata('invalidAuthenInfo', 'Sai thông tin đăng nhập');
                    $this->load->view("login");
                }
            } else {
                // Sai thông tin đăng nhập
                $this->session->set_flashdata('invalidAuthenInfo', 'Sai thông tin đăng nhập');
                $this->load->view("login");
            }
        }
    }
}
