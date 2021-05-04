<?php
class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
    }

    public function index() {
        $data = [
            'subview' => 'users/index'
        ];
        $this->load->view("layout1", $data);
    }

    public function add() {
        $data = [
            'subview' => 'users/add'
        ];
        $this->load->view("layout1", $data);
    }
}