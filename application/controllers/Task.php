<?php
class Task extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("task_model");
    }

    public function index() {
        $this->load->view("task/index");
    }

    public function detail($taskid = NULL) {
        if(!$taskid) {
            $data = [
                'pageTitle' => 'Không tìm thấy chi tiết công việc',
                'subview' => 'task/nodetail'
            ];
            $this->load->view("layout1", $data);
        }

        $task_data = $this->task_model->getTaskById($taskid);

        $data = [
            'pageTitle' => 'Chi tiết công việc',
            'subview' => 'task/detail',
            'task_data' => $task_data
        ];
        $this->load->view("layout1", $data);
    }
}