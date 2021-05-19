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
}
