<?php
class Task extends CI_Controller
{
    const STRING_NOT_FOUND = "Không tìm thấy công việc này";
    const STRING_UNAUTHORIZED = "Không có quyền thực hiện thao tác này";
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
        $staffOfDepartmentList = $this->user_model->getStaffListByDepartment($this->session->userdata("department"));

        $data = [
            'pageTitle' => 'Thêm công việc mới',
            'subview' => 'task/add',
            'department_staff_list' => $staffOfDepartmentList,
            'isAdmin' => $this->session->userdata("role") == 1
        ];
        $this->load->view("layout1", $data);
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
            $rules = [
                [
                    'field' => 'task_status',
                    'label' => 'Trạng thái công việc',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Trạng thái công việc không được rỗng',
                    ]
                ]
            ];

            $this->form_validation->set_rules($rules);

            if(!$this->form_validation->run()) {
                $this->load->view("task/edit/$taskid");
            }
            else {
                $data = [
                    'status' => $this->input->post("task_status", TRUE)
                ];

                $this->db->where('id', $taskid);
                $this->db->update('tasks', $data);
                // var_dump($this->input->post("task_status", TRUE));
                redirect("task/detail/$taskid");
            }
        }
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
    }
}
