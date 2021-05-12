<?php
class Task_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function getAllTasks() {
        /*
        SELECT u1.fullname AS 'creator_fullname', u2.fullname AS 'handler_fullname' 
        FROM `tasks` 
        JOIN `users` AS u1 ON u1.id = tasks.creator 
        JOIN `users` AS u2 ON u2.id = tasks.handler
        */
        $query = $this->db->select("u1.fullname AS 'creator_fullname', u2.fullname AS 'handler_fullname', tasks.id, tasks.title, tasks.content, tasks.created_at")
        ->from("tasks")
        ->join("users AS u1","tasks.creator = u1.id")
        ->join("users AS u2","tasks.handler = u2.id")
        ->get();
        return $query->result_array();
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

    public function isAuthorized($user = NULL, $task_id) {
        if(!$user) {
            return false;
        }

        $query = $this->db->select("T.id, U.department")->from('tasks as T')
        ->join("users AS U","U.id = T.creator")->where('T.id', $task_id)->get();
        $res = $query->row_array();
        if($res['department'] == $user['department']) {
            return true;
        }
        else {
            return false;
        }
    }
}