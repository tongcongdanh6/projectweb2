<?php
class Task_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model("user_model");
        $this->load->model("department_model");
    }

    public function addNewTask($taskdata = NULL)
    {
        if (!$taskdata) {
            return false;
        }
        $this->db->insert("tasks", $taskdata);
        $insert_id = $this->db->insert_id();
        return $insert_id;
        // return true;
    }

    public function deleteTaskWithTaskId($tid)
    {
        // Nếu không có $tid trong table thì hàm return false
        return $this->db->delete("tasks", ['id' => $tid]);
    }

    public function getAllTasks()
    {
        /*
        SELECT u1.fullname AS 'creator_fullname', u2.fullname AS 'handler_fullname' 
        FROM `tasks` 
        JOIN `users` AS u1 ON u1.id = tasks.creator 
        JOIN `users` AS u2 ON u2.id = tasks.handler
        */
        $query = $this->db->select("u1.fullname AS 'creator_fullname', u2.fullname AS 'handler_fullname', tasks.id, tasks.title, tasks.content, tasks.created_at")
            ->from("tasks")
            ->join("users AS u1", "tasks.creator = u1.id")
            ->join("users AS u2", "tasks.handler = u2.id")
            ->get();
        return $query->result_array();
    }

    public function getTasksByDepartmentToTable($id)
    {
        if (!$id) return;

        $query = $this->db->select("u1.fullname AS 'creator_fullname', u2.fullname AS 'handler_fullname', tasks.id, tasks.title, tasks.content, tasks.created_at")
            ->from("tasks")->where("tasks.creator", $this->session->userdata("id"))
            ->join("users AS u1", "tasks.creator = u1.id")
            ->join("users AS u2", "tasks.handler = u2.id")
            ->get();

        return $query->result_array();
    }

    public function getTasksByIdHandlerToTable($id)
    {
        if (!$id) return [];
        $query = $this->db->select("u1.fullname AS 'creator_fullname', u2.fullname AS 'handler_fullname', tasks.id, tasks.title, tasks.content, tasks.created_at")
            ->from('tasks')->where("handler", $id)
            ->join("users AS u1", "tasks.creator = u1.id")
            ->join("users AS u2", "tasks.handler = u2.id")
            ->get();
        return $query->result_array();
    }

    public function getTasksByDepartment($idOrslug)
    {
        if (!$idOrslug) return;

        if (is_numeric($idOrslug)) {
            $query = $this->db->select(array('tasks.id', 'tasks.creator', 'tasks.handler', 'tasks.title', 'tasks.content', 'tasks.status', 'tasks.created_at', 'tasks.soft_delete'))
                ->from('tasks')->join('users', 'tasks.handler = users.id')
                ->join('department', 'users.department = department.id')
                ->where('department.id', $idOrslug)
                ->get();
        } else {
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
            $query = $this->db->select(array('tasks.id', 'tasks.creator', 'tasks.handler', 'tasks.title', 'tasks.content', 'tasks.status', 'tasks.created_at', 'tasks.soft_delete'))
                ->from('tasks')->join('users', 'tasks.handler = users.id')
                ->join('department', 'users.department = department.id')
                ->where('department.slug', $idOrslug)
                ->get();
        }
        return $query->result_array();
    }

    public function getTaskById($task_id = NULL)
    {
        if (!$task_id) {
            return null;
        }

        $query = $this->db->select("*")->from('tasks')->where("id", $task_id)->get();
        return $query->result_array();
    }

    public function getTasksByIdHandler($id)
    {
        if (!$id) return [];
        $query = $this->db->select("*")->from('tasks')->where("handler", $id)->get();
        return $query->result_array();
    }

    public function isAuthorized($user = NULL, $task_id)
    {
        if (!$user || !$task_id) {
            return false;
        }

        // 1) Nếu task do Admin tạo
        $query = $this->db->select("creator")->from("tasks")->where("id", $task_id)->get();
        $res = $query->row_array();
        if ($this->user_model->isAdmin($res['creator'])) {
            // 1.1) Nếu user hiện tại là trưởng phòng thì kiểm tra xem handler của task này có thuộc cùng phòng ban với user trưởng phòng này hay không
            if ($user['position'] == 1) {
                $query = $this->db->select("handler")->from("tasks")->where("id", $task_id)->get();
                $handler_department = $this->user_model->getDepartmentIdByUserId($query->row_array()['handler']);
                if ($user['department'] == $handler_department) {
                    return true;
                } else {
                    return false;
                }
            } else {
                // 1.2 Nếu là nhân viên thì check xem handler này có phải là id user hiện tại hay không?
                $query = $this->db->select("handler")->from("tasks")->where("id", $task_id)->get();
                if ($query->row_array()['handler'] == $user['id']) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        // 2) Nếu task do Trưởng phòng tạo
        else {
            // 2.1 Nếu user hiện tại là TRƯỞNG PHÒNG, kiểm tra xem phòng ban task handler này có thuộc phòng ban mình không
            if ($this->session->userdata("position") == 1) {
                $query = $this->db->select("handler")->from("tasks")->where("id", $task_id)->get();
                $handler_department = $this->user_model->getDepartmentIdByUserId($query->row_array()['handler']);
                if ($user['department'] == $handler_department) {
                    return true;
                } else {
                    return false;
                }
            }
            else {
                $query = $this->db->select("handler")->from("tasks")->where("id", $task_id)->get();
                if ($query->row_array()['handler'] == $user['id']) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}
