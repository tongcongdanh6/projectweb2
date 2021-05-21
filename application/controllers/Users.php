<?php
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->library("form_validation");
        $this->load->library("encryption");
        $this->load->model("department_model");
        $this->load->model("user_model");
        $this->load->model("register_model");
        $this->load->model("notification_model");

        // Kiểm tra đăng nhập
        if (!$this->session->has_userdata('logged_in')) {
            redirect("login");
        }

        if (intval($this->session->userdata("role")) !== 1) {
            redirect("dashboard");
        }
    }

    public function index()
    {
        // Lấy staff list hiển thị view từ trong User Model & Department Model
        $staff_list = [];
        foreach ($this->user_model->getStaffList() as $s) {
            array_push($staff_list, [
                'id' => $s['id'],
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

        // NOTIFICATION DATA
        $data['notification_data'] = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach ($data['notification_data'] as $n) {
            if ($n["mark_read"] == 0) $count_unread++;
        }
        $data['count_unread_notification'] = $count_unread;
        // #NOTIFICATION DATA

        $this->load->view("layout1", $data);
    }

    public function add()
    {
        $data = [
            'pageTitle' => 'Thêm nhân viên mới',
            'subview' => 'users/add',
            'department_list' => $this->department_model->getListDepartment()
        ];

        // NOTIFICATION DATA
        $data['notification_data'] = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach ($data['notification_data'] as $n) {
            if ($n["mark_read"] == 0) $count_unread++;
        }
        $data['count_unread_notification'] = $count_unread;
        // #NOTIFICATION DATA

        $this->load->view("layout1", $data);
    }

    public function doAddNewStaff()
    {
        // Kiểm tra thông tin nhập
        $rules = [
            [
                'field' => 'staff_fullname',
                'label' => 'Họ tên nhân viên',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Họ tên nhân viên không được rỗng',
                ]
            ],
            [
                'field' => 'staff_email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'Email không được rỗng',
                    'valid_email' => 'Vui lòng điền email hợp lệ'
                ]
            ],
            [
                'field' => 'staff_password',
                'label' => 'Mật khẩu',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mật khẩu không được rỗng'
                ]
            ]
        ];

        $this->form_validation->set_rules($rules);

        if (!$this->form_validation->run()) {
            $data = [
                'pageTitle' => 'Thêm nhân viên mới',
                'subview' => 'users/add',
                'department_list' => $this->department_model->getListDepartment()
            ];
            $this->load->view("layout1", $data);
        } else {
            // Dữ liệu hợp lệ thì thêm vào hệ thống
            // Mã hóa password
            $encrypted_password = $this->encryption->encrypt($this->input->post("staff_password", TRUE));

            $data = [
                'email' => $this->input->post("staff_email", TRUE),
                'password' => $encrypted_password,
                'fullname' => $this->input->post("staff_fullname", TRUE),
                'department' => $this->department_model->getIdDepartment($this->input->post("staff_department")),
                'created_at' => date("Y-m-d h:i:sa")
            ];


            if ($this->register_model->addNewUser($data) === true) {
                $this->load->view("register_successfully");
                redirect("users");
            } else if ($this->register_model->addNewUser($data) === -1) {
                $this->load->view("duplicate_email");
            } else {
                $this->load->view("register_fail");
            }
        }
    }
}
