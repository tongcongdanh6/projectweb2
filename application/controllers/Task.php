<?php
class Task extends CI_Controller
{
    const STRING_NOT_FOUND = "Không tìm thấy công việc này";
    const STRING_UNAUTHORIZED = "Không có quyền thực hiện thao tác này";
    const STRING_CANNOT_DELETE = "Không thể xóa thành công dữ liệu này";
    const LABEL_ERROR = "Có lỗi xảy ra";

    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->library("form_validation");
        $this->load->library("parser");
        $this->load->helper("text");
        $this->load->model("task_model");
        $this->load->model("user_model");
        $this->load->model("department_model");
        $this->load->model("notification_model");
        // Kiểm tra đăng nhập
        if (!$this->session->has_userdata('logged_in')) {
            redirect("login");
        }
    }

    public function index()
    {

        if (intval($this->session->userdata("role")) == 1) {
            // Nếu là admin thì lấy full danh sách task
            $tasks_data = $this->task_model->getAllTasks();
        } else {
            // Không là admin thì nếu là Trưởng phòng thì lấy danh sách task theo phòng ban mà trưởng phòng quản lý
            if (intval($this->session->userdata("position")) == 1) {
                $tasks_data = $this->task_model->getTasksByDepartmentToTable($this->session->userdata("department"));
            } else {
                $tasks_data = $this->task_model->getTasksByIdHandlerToTable($this->session->userdata("id"));
            }
        }

        $data = [
            'pageTitle' => 'Danh sách công việc',
            'subview' => 'task/index',
            'tasks_data' => $tasks_data
        ];

        // NOTIFICATION 
        $data['notification_data'] = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach ($data['notification_data'] as $n) {
            if ($n["mark_read"] == 0) $count_unread++;
        }
        $data['count_unread_notification'] = $count_unread;

        // Nếu request có chứa query noti_id thì thực hiện mark đã đọc
        if (isset($_GET["noti_id"])) {
            // Trước khi set mark là đã đọc thì check xem noti này có thuộc về user này không?
            if ($this->notification_model->isNotificationBelongCurrentUserWithNotiId($_GET["noti_id"])) {
                // Nếu TRUE thì set đã đọc cho noti_id này
                $this->notification_model->markReadNotification($_GET["noti_id"]);
            }
        }

        // NOTIFICATION

        $this->load->view("layout1", $data);
    }

    private function checkAuthorizedByTaskId($taskid)
    {
        if ($this->session->userdata("role") == 1) {
            // Là admin thì luôn luôn TRUE
            return true;
        } else {
            return $this->task_model->isAuthorized($this->session->userdata(), $taskid);
        }
    }

    public function detail($taskid = NULL)
    {
        // Kiểm tra task có tồn tại hay không
        if (!$taskid) {
            show_error(self::STRING_NOT_FOUND, 404, self::LABEL_ERROR);
        }

        // Lấy task detail theo ID
        $task_data = $this->task_model->getTaskById($taskid);

        // Nếu task có tồn tại
        // Thêm attr "handler_fullname" vào $task_data để hiển thị ra bên ngoài frontend
        $task_data[0]["handler_fullname"] = $this->user_model->getFullNameByUserId(intval($task_data[0]['handler']));

        // NOTIFICATION 
        // Nếu request có chứa query noti_id thì thực hiện mark đã đọc
        if (isset($_GET["noti_id"])) {
            // Trước khi set mark là đã đọc thì check xem noti này có thuộc về user này không?
            if ($this->notification_model->isNotificationBelongCurrentUserWithNotiId($_GET["noti_id"])) {
                // Nếu TRUE thì set mark read
                $this->notification_model->markReadNotification($_GET["noti_id"]);
                redirect("task/detail/" . $taskid);
            }
        }
        // ##NOTIFICATION##

        $data = [
            'pageTitle' => 'Chi tiết công việc',
            'subview' => 'task/detail',
            'task_data' => $task_data,
            'isAuthorized' => $this->checkAuthorizedByTaskId($taskid) // Kiểm tra quyền truy cập vào detail dựa vào quyền phòng ban
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

        if (intval($this->session->userdata("role")) == 1 || intval($this->session->userdata("position")) == 1) {
            $staffOfDepartmentList = $this->user_model->getStaffListByDepartment($this->session->userdata("department"));
            $data = [
                'pageTitle' => 'Thêm công việc mới',
                'subview' => 'task/add',
                'department_staff_list' => $staffOfDepartmentList,
                'isAdmin' => $this->session->userdata("role") == 1
            ];

            // Modify lại staff list là full staff nếu như quyền là Admin
            if (intval($this->session->userdata("role")) == 1) {
                $listDepartmentOrdered = $this->department_model->getListDepartmentOrderById();
                $res = [];
                foreach ($listDepartmentOrdered as $listD) {
                    $res[$listD['name']] = $this->user_model->getStaffListByDepartment($listD['id']);
                }
                $data['department_staff_list'] = $res;
            }

            // NOTIFICATION DATA
            $data['notification_data'] = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
            $count_unread = 0;
            foreach ($data['notification_data'] as $n) {
                if ($n["mark_read"] == 0) $count_unread++;
            }
            $data['count_unread_notification'] = $count_unread;
            // #NOTIFICATION DATA

            $this->load->view("layout1", $data);
        } else {
            show_error(self::STRING_UNAUTHORIZED, 403, self::LABEL_ERROR);
        }
    }

    public function doAddNewTask()
    {
        if (!isset($_SERVER["HTTP_REFERER"]) || (isset($_SERVER["HTTP_REFERER"])) && ($_SERVER["HTTP_REFERER"] != base_url() . "task/add")) {
            show_error("Không được thực hiện thao tác này", 403, "Có lỗi xảy ra");
        } else {
            // Kiểm tra thông tin nhập
            $rules = [
                [
                    'field' => 'task_title',
                    'label' => 'Tiêu đề công việc',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'Tiêu đề công việc không được rỗng',
                    ]
                ],
                [
                    'field' => 'task_handler',
                    'label' => 'Người được giao',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'Người được giao không được rỗng',
                    ]
                ],
                [
                    'field' => 'task_content',
                    'label' => 'Nội dung công việc',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nội dung công việc không được rỗng'
                    ]
                ],
                [
                    'field' => 'task_deadline',
                    'label' => 'Deadline công việc',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deadline công việc không được rỗng'
                    ]
                ]

            ];

            $this->form_validation->set_rules($rules);

            if (!$this->form_validation->run()) {
                $this->add();
            } else {

                $data = [
                    'creator' => $this->user_model->getUserIdByEmail($this->session->userdata("email")),
                    'handler' => intval($this->input->post("task_handler", TRUE)),
                    'title' => $this->input->post("task_title", TRUE),
                    'slug' => url_title(convert_accented_characters($this->input->post("task_title", TRUE)), 'dash', true),
                    'content' => $this->input->post("task_content", TRUE),
                    'deadline' => date("Y-m-d H:i:s", strtotime($this->input->post("task_deadline", TRUE))),
                    'created_at' => date("Y-m-d H:i:s")
                ];

                if ($tid = $this->task_model->addNewTask($data)) {
                    // ADD TASK Thành công thì thêm vào bảng notification ở DB
                    $data_noti = [
                        'belong_uid' => intval($this->input->post("task_handler", TRUE)),
                        'taskid' => $tid,
                        'content' => $this->input->post("task_title", TRUE),
                        'created_at' => date("Y-m-d H:i:s")
                    ];

                    $this->notification_model->addNotification($data_noti);
                    redirect("task");
                }
            }
        }
    }

    public function edit($taskid)
    {
        // Lấy task detail theo ID
        $task_data = $this->task_model->getTaskById($taskid);
        // Kiểm tra task có tồn tại hay không
        if (!$task_data) {
            show_error(self::STRING_NOT_FOUND, 404, self::LABEL_ERROR);
        }

        // Nếu là admin thì thực hiện lấy danh sách stafflist theo phòng ban đó dựa vào creator, handler
        if (intval($this->session->userdata("role")) == 1) {
            // Lấy department của creator
            $departmentId = $this->user_model->getDepartmentIdByUserId(intval($task_data[0]["creator"]));
            // Lấy stafflist theo department đó
        } else {
            if (intval($this->session->userdata("position")) == 1) {
                $departmentId = $this->session->userdata("department");
            } else {
                // Nếu là nhân viên thì chỉ được cập nhật trạng thái công việc
                $departmentId = $this->user_model->getDepartmentIdByUserId(intval($task_data[0]["handler"]));
            }
        }

        $stafflist = $this->user_model->getStaffListByDepartment($departmentId);
        $data = [
            'pageTitle' => 'Chỉnh sửa công việc',
            'subview' => 'task/edit',
            'task_data' => $task_data,
            'stafflist' => $stafflist,
            'isAuthorized' => $this->checkAuthorizedByTaskId($taskid)
        ];

        // NOTIFICATION 
        $data['notification_data'] = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach ($data['notification_data'] as $n) {
            if ($n["mark_read"] == 0) $count_unread++;
        }
        $data['count_unread_notification'] = $count_unread;
        // NOTIFICATION 

        $this->load->view("layout1", $data);
    }

    public function doEditTask($taskid)
    {
        if ($this->session->userdata("position") != 1) {
            if (is_null($this->input->post("task_status", TRUE))) {
                $this->session->set_flashdata("message", "Trạng thái công việc không được rỗng");
                redirect("task/edit/$taskid");
            } else {
                $data = [
                    'status' => $this->input->post("task_status", TRUE)
                ];

                $this->db->where('id', $taskid);
                $this->db->update('tasks', $data);

                //redirect("task/detail/$taskid");
            }
        } else {
            // Kiểm tra thông tin nhập
            $rules = [
                [
                    'field' => 'task_title',
                    'label' => 'Tiêu đề công việc',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'Tiêu đề công việc không được rỗng',
                    ]
                ],
                [
                    'field' => 'task_handler',
                    'label' => 'Người được giao',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'Người được giao không được rỗng',
                    ]
                ],
                [
                    'field' => 'task_content',
                    'label' => 'Nội dung công việc',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nội dung công việc không được rỗng'
                    ]
                ],
                [
                    'field' => 'task_deadline',
                    'label' => 'Deadline công việc',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deadline công việc không được rỗng'
                    ]
                ],
                [
                    'field' => 'task_status',
                    'label' => 'Trạng thái công việc',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Trạng thái công việc không được rỗng'
                    ]
                ]
            ];

            $this->form_validation->set_rules($rules);

            if (!$this->form_validation->run()) {
                $this->load->view("task/edit/$taskid");
            } else {
                $data = [
                    'title' => $this->input->post("task_title", TRUE),
                    'status' => $this->input->post("task_status", TRUE),
                    'handler' => $this->input->post("task_handler", TRUE),
                    'content' => $this->input->post("task_content", TRUE),
                    'deadline' => date("Y-m-d H:i:s", strtotime($this->input->post("task_deadline", TRUE)))
                ];

                $this->db->where('id', $taskid);
                $this->db->update('tasks', $data);
            }
        }

        // Gửi notification cho người đã giao Task này thông báo việc Status Task vừa update
        if (isset($taskid)) {
            // Lấy data task với taskid hiện tại
            $taskdata = $this->task_model->getTaskById($taskid)[0];

            // Tạo nội dung cho content notification dựa vào task_status vừa được update
            $noti_content = "";
            switch (intval($taskdata['status'])) {
                case 2:
                    $noti_content = $this->user_model->getFullNameByUserId($taskdata['handler']) . " đang thực hiện " . $taskdata['title'];
                    break;
                case 3:
                    $noti_content = $taskdata['title'] . " đã bị trì hoãn bởi " . $this->user_model->getFullNameByUserId($taskdata['creator']);
                    break;
                case 4:
                    $noti_content = $this->user_model->getFullNameByUserId($taskdata['handler']) . " đã hoàn thành " . $taskdata['title'];
                    break;
                default:
                    $noti_content = "Unknown Notification";
                    break;
            }

            $data_noti = [
                'type_notification' => $taskdata['status'],
                'belong_uid' => intval($taskdata['creator']),
                'taskid' => $taskid,
                'content' => $noti_content,
                'created_at' => date("Y-m-d H:i:s")
            ];

            if ($taskdata['status'] == 3) {
                // Nếu job bị hoãn thì tạo noti cho cả 2 bên người tạo và người đc giao job
                $this->notification_model->addNotification($data_noti);
                $data_noti['belong_uid'] = intval($taskdata['handler']);
                $this->notification_model->addNotification($data_noti);
            } else {
                $this->notification_model->addNotification($data_noti);
            }
        }
        redirect("task/detail/$taskid");
        // # Gửi notification
    }

    private function broadcastNotification($role, $position, $data, $action)
    {
        if ($action == "add") {
        } else {
        }
    }

    public function delete($taskid)
    {
        // Nếu không tìm thấy task với taskid này thì báo lỗi không tìm thấy task
        if (!$this->task_model->getTaskById($taskid)) {
            show_error(self::STRING_NOT_FOUND, 404, self::LABEL_ERROR);
        } else {
            if (!$this->task_model->deleteTaskWithTaskId($taskid)) {
                show_error(self::STRING_CANNOT_DELETE, 404, self::LABEL_ERROR);
            } else {
                $this->session->set_flashdata('message', 'Đã xóa thành công công việc có <b>Mã công việc: ' . $taskid . '</b>');
                redirect("task");
            }
        }
    }
}
