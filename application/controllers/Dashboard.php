<?php
class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("department_model");
        $this->load->model("task_model");
        $this->load->model("notification_model");
        // Kiểm tra đăng nhập
        if (!$this->session->has_userdata('logged_in')) {
            redirect("login");
        }
    }

    public function index() {
        // NOTIFICATION
        $notification_list = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach($notification_list as $n) {
            if($n["mark_read"] == 0) $count_unread++;
        }

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
                'notification_data' => $notification_list,
                'count_unread_notification' => $count_unread,
                'subview' => 'dashboard/admindashboard',
                'department_data' => $department_data,
                'tasks_data' => $tasks_data
            ];
            $this->load->view("layout1", $data);
        }
        // Bảng quản trị cho Truong Phong
        else if(intval($this->session->userdata("position")) === 1) {
            // Lấy dữ liệu Task cho phòng ban mà trưởng phỏng đang quản lý
            $tasks_data = $this->task_model->getTasksByDepartment(intval($this->session->userdata("department")));

            $data = [
                'pageTitle' => 'Bảng điều khiển chung',
                'notification_data' => $notification_list,
                'count_unread_notification' => $count_unread,
                'subview' => 'dashboard/truongphong_dashboard',
                'tasks_data' => $tasks_data
            ];
            $this->load->view("layout1", $data);
        }
        // Bảng quản trị cho nhân viên
        else {
            // Lấy dữ liệu task mà nhân viên được giao
            $tasks_data = $this->task_model->getTasksByIdHandler($this->session->userdata("id"));
            $data = [
                'pageTitle' => 'Bảng điều khiển chung',
                'notification_data' => $notification_list,
                'count_unread_notification' => $count_unread,
                'subview' => 'dashboard/nhanvien_dashboard',
                'tasks_data' => $tasks_data
            ];
            $this->load->view("layout1", $data);
        }
    }

    public function test() {
        echo "test";
    }
}