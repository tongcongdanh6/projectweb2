<?php
class Notification_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getNotificationListByUserId($uid) {
        $query = $this->db->select("*")->from("notification")->where("belong_uid", $uid)->limit(5)->order_by('created_at','DESC')->get();

        return $query->result_array();
    }
    
    public function isNotificationBelongCurrentUserWithNotiId($nid) {
        $query = $this->db->select("*")
        ->from("notification")
        ->where("id", $nid)
        ->where("belong_uid", $this->session->userdata("id"));

        return $query->count_all_results() == 1;
    }

    public function markReadNotification($nid) {
        if(!$nid) return;
        
        $this->db->where('id', $nid);
        $this->db->update('notification', ["mark_read" => 1]);
        return true;
    }

    public function addNotification($data) {
        if(!$data) {
            return false;
        }
        
        return $this->db->insert("notification", $data);
    }
}
