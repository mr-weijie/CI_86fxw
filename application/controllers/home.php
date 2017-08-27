<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 为了使用身份验证，改为继承自定义的安全检测控制类MY_Controller
*/
class Home extends MY_Controller {

public function index(){
    $this->load->view('header.html');
    $this->load->view('index/banner.html');
    $this->load->view('index/nav.html');
    $this->load->view('index/flash.html');
    $this->load->view('index/gonggao.html');
    $this->load->view('index/index_con.html');
    $this->load->view('index/copyright.html');
    $this->load->view('footer.html');
}

public function about(){
    $this->load->view('header.html');
    $this->load->view('index/banner.html');
    $this->load->view('index/nav.html');
    $this->load->view('index/flash.html');
    $this->load->view('index/position_nav.html');
    $this->load->view('index/about.html');
    $this->load->view('index/copyright.html');
    $this->load->view('footer.html');

}
}
?>