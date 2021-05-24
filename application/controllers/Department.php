<?php
class Department extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->library("form_validation");
        $this->load->library("parser");
        $this->load->helper("text");
        $this->load->model("department_model");
        $this->load->model("user_model");
        $this->load->model("notification_model");
        // Kiểm tra đăng nhập
        if (!$this->session->has_userdata('logged_in')) {
            redirect("login");
        }
    }

    public function index()
    {
        // Kiểm tra permission. Chỉ ADMIN được vào module Department
        if ($this->session->userdata("role") != 1) {
            show_error('Không có quyền vào đây', 403, 'Có lỗi xảy ra');
        }

        $notification_list = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach ($notification_list as $n) {
            if ($n["mark_read"] == 0) $count_unread++;
        }

        // Department List to Front End
        $department_list =  $this->department_model->getListDepartment();
        foreach ($department_list as $k => $l) {
            $department_list[$k]['nameheadof'] = $this->department_model->getNameHeadOfDepartment($l['id']);
        }

        $data = [
            'pageTitle' => 'Danh sách phòng ban',
            'notification_data' => $notification_list,
            'count_unread_notification' => $count_unread,
            'department_list' => $department_list,
            'subview' => 'department/index'
        ];


        $this->load->view("layout1", $data);
    }

    public function add()
    {
        // Kiểm tra permission. Chỉ ADMIN được vào module Department
        if ($this->session->userdata("role") != 1) {
            show_error('Không có quyền vào đây', 403, 'Có lỗi xảy ra');
        }

        $notification_list = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach ($notification_list as $n) {
            if ($n["mark_read"] == 0) $count_unread++;
        }

        $data = [
            'pageTitle' => 'Thêm phòng ban mới',
            'notification_data' => $notification_list,
            'count_unread_notification' => $count_unread,
            'staff_list' => $this->user_model->getStaffList(),
            'subview' => 'department/add'
        ];


        $this->load->view("layout1", $data);
    }

    public function doAddNewDepartment()
    {
        // Kiểm tra permission. Chỉ ADMIN được vào module Department
        if ($this->session->userdata("role") != 1) {
            show_error('Không có quyền vào đây', 403, 'Có lỗi xảy ra');
        }

        $notification_list = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach ($notification_list as $n) {
            if ($n["mark_read"] == 0) $count_unread++;
        }

        $rules = [
            [
                'field' => 'department_name',
                'label' => 'Tên phòng ban',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tên phòng ban không được rỗng'
                ]
            ]
        ];

        $this->form_validation->set_rules($rules);
        if (!$this->form_validation->run()) {
            $data = [
                'pageTitle' => 'Thêm phòng ban mới',
                'notification_data' => $notification_list,
                'count_unread_notification' => $count_unread,
                'staff_list' => $this->user_model->getStaffList(),
                'subview' => 'department/add'
            ];
            $this->load->view("layout1", $data);
        } else {
            // Kiểm tra xem với người được chọn đã là làm trưởng phòng phòng ban nào chưa, nếu có thì báo lỗi
            if ($this->user_model->getPositionByUserId($this->input->post("head_of_department", TRUE)) == 1) {
                $this->session->set_flashdata("message", "Người này đã làm trưởng phòng của phòng ban khác rồi");
                redirect("department/add");
            } else {
                // Chèn dữ liệu
                $newDepartmentId = $this->department_model->addNewDepartment([
                    'name' => $this->input->post("department_name", TRUE),
                    'slug' => url_title(convert_accented_characters($this->input->post("department_name", TRUE)), 'dash', true)
                ]);
                $this->user_model->updateUser([
                    'position' => 1,
                    'department' => $newDepartmentId
                ], $this->input->post("head_of_department", TRUE));

                $this->session->set_flashdata("message", "Thêm phòng ban thành công");
                redirect("department");
            }
        }
    }
}
