<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 为了使用身份验证，改为继承自定义的安全检测控制类MY_Controller
*/
class Home extends MY_Controller {

public function index(){
    $this->load->model('database_model','database');
    $data['index_con']=$this->database->getinfo('index_con');
    $data['position']='<a href="/">首页</a>';
    $this->loadproc('index_con.html',$data);
}

public function about(){
    $this->load->model('database_model','database');
    $data['info']=$this->database->getinfo('about');
    $data['position']='<a href="/">首页</a>->关于我们 ';
    $this->loadproc('about.html',$data);

}
public function news(){
    $this->loadproc('news.html');

}
public function products(){
    $this->load->model('database_model','database');
    $data['sysinfo']=$this->database->getsysinfo();
    $data['flash']=$this->database->getflash();
    $data['index_con']=$this->database->getindex_con();
    $data['position']='<a href="/">首页</a>';
    p($data);
    $this->loadproc('products.html',$data);

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

private function loadproc($proc,$data){
    $this->load->model('database_model','database');
    $sysdata['sysinfo']=$this->database->getsysinfo();
    $sysdata['flash']=$this->database->getflash();

    $this->load->view('header.html',$sysdata);
    $this->load->view('index/banner.html');
    $this->load->view('index/nav.html');
    $this->load->view('index/flash.html');
    $this->load->view('index/gonggao.html');
    $this->load->view('index/position_nav.html',$data);
    $this->load->view('index/'.$proc);
    $this->load->view('index/copyright.html');
    $this->load->view('footer.html');

}
}
?>