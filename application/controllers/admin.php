<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 9:18
 */
class Admin extends MY_Controller{
    public function index(){
        $this->load->view('header.html');
        $this->load->view('admin/index.html');
    }
    public function adm(){
        $this->load->view('admin/index.html');

    }
}