<?php
class Task_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function getTasksByDepartment($slug_department = "") {
        if($slug_department == "") {
            return [];
        }
        // RETURN: Array of task of a department with the key
        /*
            [
                'id' =>
                'creator' =>
                'handler' =>
                'title' =>
                'content' =>
                'status' =>
                'created_at' =>
                'soft_delete' =>
            ]
        */

        // $query = '
        // SELECT tasks.id, tasks.creator, tasks.handler, tasks.title, tasks.content, tasks.status, tasks.created_at, tasks.soft_delete FROM `tasks` JOIN `users` ON tasks.creator = users.id JOIN `department` ON users.department = department.id
        // ';
        // Using Query Builder
        $query = $this->db->select(array('tasks.id', 'tasks.creator','tasks.handler','tasks.title','tasks.content','tasks.status','tasks.created_at','tasks.soft_delete'))
        ->from('tasks')->join('users','tasks.creator = users.id')
        ->join('department','users.department = department.id')
        ->where('department.slug',$slug_department)
        ->get();

        return $query->result_array();
    }

    public function getTaskById($task_id = NULL) {
        if(!$task_id) {
            return [];
        }

        $query = $this->db->select("*")->from('tasks')->where("id",$task_id)->get();
        return $query->result_array();
    }
}