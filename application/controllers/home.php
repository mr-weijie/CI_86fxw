<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 为了使用身份验证，改为继承自定义的安全检测控制类MY_Controller
*/
class Home extends MY_Controller {

public function index(){
    $this->load->model('database_model','database');
    $data['index_con']=$this->database->getindex_con();
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
    $this->load->library('pagination');
    $pageNo=$this->uri->segment(3);
    $pageNo=isset($pageNo)?$pageNo:1;
    $perpage=20;
    $config['base_url']=site_url('home/news/');
    $config['total_rows'] = $this->db->where(array('rectype'=>'news'))->count_all_results('content');
    $config['uri_segment']=3;
    $config['per_page']=$perpage;

    $config['first_link'] = '第一页';
    $config['prev_link'] = '上一页';
    $config['next_link'] = '下一页';
    $config['last_link'] = '最后一页';

    $this->pagination->initialize($config);//初始化
    $links = $this->pagination->create_links();
    $offset=$this->uri->segment( $config['uri_segment']);
    // p($offset);
    $this->db->limit($perpage, $offset);
    $this->load->model('database_model','database');
    $data['info']=$this->database->getnewslist();
    $data['position']='<a href="/">首页</a>->业界原创 ';
    $data['links']=$links;
    $data['total_rows']= $config['total_rows'];
    $data['cur_page']=$offset;
    $pstart=$offset+1;
    $pstop=$offset+$perpage;
    $pstop=$pstop>$config['total_rows'] ?$config['total_rows']:$pstop;
    $data['offset']=$pstart.'-'.$pstop;
    $this->loadproc('news.html',$data);

}
public function shownews(){
    $rowid=$this->uri->segment(3);
    $this->load->model('database_model','database');
    $data['news']=$this->database->getnews($rowid);
    $data['position']='<a href="/">首页</a>-><a href="'.site_url('home/news').'">业界原创</a>  ';
  //  p($data);
    $this->loadproc('shownews.html',$data);

}
public function products(){
    $this->load->model('database_model','database');
    $data['products']=$this->database->getproducts();
    $data['position']='<a href="/">首页</a>->产品展示';
   // p($data);
    $this->loadproc('products.html',$data);
}
public function product(){
    $this->load->model('database_model','database');
    $rowid=$this->uri->segment(3);
    $data['info']=$this->database->getproduct($rowid);
    $data['position']='<a href="/">首页</a>-><a href="'.site_url('home/products').'">产品展示</a> ';
    $this->loadproc('about.html',$data);

}


public function customized(){
    $this->load->model('database_model','database');
    $data['info']=$this->database->getinfo('customized');
    $data['position']='<a href="/">首页</a>->服务定制';
    // p($data);
    $this->loadproc('about.html',$data);

}

public function agent(){
    $this->load->model('database_model','database');
    $data['info']=$this->database->getinfo('agent');
    $data['position']='<a href="/">首页</a>->代理招商';
    $this->loadproc('about.html',$data);

}
public function success(){
    $this->load->model('database_model','database');
    $data['info']=$this->database->getinfo('success');
    $data['position']='<a href="/">首页</a>->成功案例';
    $this->loadproc('about.html',$data);

}
public function price(){
    $this->load->model('database_model','database');
    $data['info']=$this->database->getinfo('price');
    $data['position']='<a href="/">首页</a>->产品价格';
    $this->loadproc('about.html',$data);

}

public function useprocess(){
    $this->load->model('database_model','database');
    $data['info']=$this->database->getinfo('useprocess');
    $data['position']='<a href="/">首页</a>->使用流程';
    $this->loadproc('about.html',$data);
}
public function faq(){
    $this->load->model('database_model','database');
    $data['info']=$this->database->getinfo('faq');
    $data['position']='<a href="/">首页</a>->常见问题';
    $this->loadproc('about.html',$data);
}

private function loadproc($proc,$data){
    $this->load->model('database_model','database');
    $sysdata['sysinfo']=$this->database->getsysinfo();
    $sysdata['flash']=$this->database->getflash();
    $sysdata['price_nav']=$this->database->getprice_nav();
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