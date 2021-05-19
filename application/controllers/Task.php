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
        $this->load->model("notification_model");

        // NOTIFICATION 
        $data['notification_data'] = $this->notification_model->getNotificationListByUserId($this->session->userdata("id"));
        $count_unread = 0;
        foreach ($data['notification_data'] as $n) {
            if ($n["mark_read"] == 0) $count_unread++;
        }
        $data['count_unread_notification'] = $count_unread;
        // NOTIFICATION 
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
        var_dump($data);
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
        // Lấy task detail theo ID
        $task_data = $this->task_model->getTaskById($taskid);
        // Kiểm tra task có tồn tại hay không
        if (!$task_data) {
            show_error(self::STRING_NOT_FOUND, 404, self::LABEL_ERROR);
        }

        // Nếu task có tồn tại
        // Thêm attr "handler_fullname" vào $task_data để hiển thị ra bên ngoài frontend
        $task_data[0]["handler_fullname"] = $this->user_model->getFullNameByUserId(intval($task_data[0]['handler']));

        $data = [
            'pageTitle' => 'Chi tiết công việc',
            'subview' => 'task/detail',
            'task_data' => $task_data,
            'isAuthorized' => $this->checkAuthorizedByTaskId($taskid) // Kiểm tra quyền truy cập vào detail dựa vào quyền phòng ban
        ];
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
            $this->load->view("layout1", $data);
        } else {
            show_error(self::STRING_UNAUTHORIZED, 403, self::LABEL_ERROR);
        }
    }

    public function doAddNewTask()
    {
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

            if ($this->task_model->addNewTask($data)) {
                // $this->load->view("addtask_successfully");
                redirect("task");
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
                redirect("task/detail/$taskid");
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
                // var_dump($this->input->post("task_status", TRUE));
                redirect("task/detail/$taskid");
            }
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
