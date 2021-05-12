<?php
class Task extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("task_model");
    }

    public function index() {
        $tasks_data = $this->task_model->getAllTasks();

        $data = [
            'pageTitle' => 'Danh sách công việc',
            'subview' => 'task/index',
            'tasks_data' => $tasks_data
        ];
        $this->load->view("layout1", $data);
    }

    public function detail($taskid = NULL) {
        // Lấy task detail theo ID
        $task_data = $this->task_model->getTaskById($taskid);
        // Kiểm tra task có tồn tại hay không
        if(!$task_data) {
            $data = [
                'pageTitle' => 'Không tìm thấy chi tiết công việc',
                'subview' => 'task/nodetail'
            ];
            $this->load->view("layout1", $data);
            return;
        }

        // Nếu task có tồn tại thì kiểm tra tiếp quyền truy cập vào detail dựa vào quyền phòng ban
        if($this->session->userdata("role") == 1) {
            // Là admin thì luôn luôn TRUE
            $isAuthorized = true;
        }
        else {
            $isAuthorized = $this->task_model->isAuthorized($this->session->userdata(), $taskid);
        }
        

        $data = [
            'pageTitle' => 'Chi tiết công việc',
            'subview' => 'task/detail',
            'task_data' => $task_data,
            'isAuthorized' => $isAuthorized
        ];
        $this->load->view("layout1", $data);

    }
}