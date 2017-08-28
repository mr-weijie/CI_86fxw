<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 为了使用身份验证，改为继承自定义的安全检测控制类MY_Controller
*/
class Home extends MY_Controller {

public function index(){
    $this->loadproc('index_con.html');
}

public function about(){
    $this->loadproc('about.html');

}
public function news(){
    $this->loadproc('news.html');

}
public function products(){
    $this->loadproc('products.html');

}
public function customized(){
    $this->loadproc('customized.html');

}

public function agent(){
    $this->loadproc('agent.html');

}
public function success(){
    $this->loadproc('success.html');

}
public function price(){
    $this->loadproc('price.html');

}

public function useprocess(){
    $this->loadproc('useprocess.html');
}
public function faq(){
    $this->loadproc('faq.html');
}

private function loadproc($proc){
    $this->load->view('header.html');
    $this->load->view('index/banner.html');
    $this->load->view('index/nav.html');
    $this->load->view('index/flash.html');
    $this->load->view('index/position_nav.html');
    $this->load->view('index/'.$proc);
    $this->load->view('index/copyright.html');
    $this->load->view('footer.html');

}
}
?>