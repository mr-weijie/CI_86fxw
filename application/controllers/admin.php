<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 9:18
 */
class Admin extends MY_Controller{
    public function __construct()
    {
        //构造函数
        parent::__construct();
        //parent::__construct();//必须先继承父构造函数，这样能继承基类
        $this->load->model('database_model','database');
    }


    public function index(){
        $this->load->view('header.html');
        $this->load->view('admin/index.html');
    }
    public function adm(){
        $this->load->view('admin/index.html');

    }
    public function flash(){
        $data['flash']=$this->database->getflash();
        $data['title']='Flash动画设置';
        $this->load->view('admin/header.html',$data);
        $this->load->view('admin/flash.html');
        $this->load->view('admin/footer.html');
    }
    public function sysinfo(){
        $data['sysinfo']=$this->database->getsysinfo();
        $data['title']='Flash动画设置';
        $this->load->view('admin/header.html',$data);
        $this->load->view('admin/sysinfo.html');
        $this->load->view('admin/footer.html');

    }
    public function products(){
        $this->load->library('pagination');
        $pageNo=$this->uri->segment(3);
        $pageNo=isset($pageNo)?$pageNo:1;
        $perpage=2;
        $config['base_url']=site_url('admin/products/');
        $config['total_rows'] = $this->db->count_all_results('products');
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
        $data['info']=$this->database->getproducts();
        $data['links']=$links;
        $data['total_rows']= $config['total_rows'];
        $data['cur_page']=$offset;
        $pstart=$offset+1;
        $pstop=$offset+$perpage;
        $pstop=$pstop>$config['total_rows'] ?$config['total_rows']:$pstop;
        $data['offset']=$pstart.'-'.$pstop;
        $this->load->view('admin/header.html',$data);
        $this->load->view('admin/products.html');
        $this->load->view('admin/footer.html');

    }

    public function editproduct(){
        $rowid=$this->uri->segment(3);
        $data['product']=$this->database->getproduct($rowid);
        $this->load->view('admin/editproduct.html',$data);
        $this->load->view('admin/footer.html');

    }
    public function updateproduct(){
        $rowid=$this->input->post('rowid');
        $data=array(
            'title'=>$this->input->post('title'),
            'profile'=>$this->input->post('profile'),
            'content'=>$this->input->post('content')
        );
        $status=$this->database->update_product($rowid,$data);
        if($status)
        {
            success('admin/products','产品参数设置成功！');
        }else{
            error('产品参数设置失败！');
        }

    }



    public function update_sysinfo(){
        $ID=$this->input->post('ID');
        $data=array(
            'address'      =>$this->input->post('address'),
            'url'          =>$this->input->post('url'),
            'corporation' =>$this->input->post('corporation'),
            'phone'        =>$this->input->post('phone'),
            'qq'            =>$this->input->post('qq'),
            'worktime'     =>$this->input->post('worktime'),
            'gonggao'      =>$this->input->post('gonggao')
        );
        $status=$this->database->update_sysinfo($data,$ID);
        if($status)
        {
            success('admin/sysinfo','系统参数设置成功！');
        }else{
            error('系统参数设置失败！');
        }

    }



    public function upload(){
        $pid=$this->uri->segment(3);
        if(!isset($pid)){
            error('请正确上传图片');
            die();
        }
        $config['upload_path']='./assets/advs/';
        $config['allowed_types']='gif|jpg|png|jpeg';
        $config['overwrite']=true;//遇到同名的覆盖
       // $config['file_name']=time().mt_rand(1000,9999);
        $config['file_name']='flash'.$pid;//用clientID做为图片文件名
//载入上传类
        $this->load->library('upload',$config);
        $status=$this->upload->do_upload('upfile');//此处的参数必须与表单中的文件字段名字相同
        if($status){
            $photofile=$this->upload->data('file_name');//返回已保存的文件名
            $this->load->model('database_model','database');
            $data=$this->database->uploadfile($pid,$photofile);
            if($data)
            {
                redirect(site_url('admin/flash'));
            }else{
                error("对不起！图片上传失败！");
            }
        }else
        {
            error('请正确选择图片后再上传！');
        }
    }

    public function update_flash(){
        $width=$this->input->post('width');
        $height=$this->input->post('height');
        $title=$this->input->post('title');
        $data=array(
            'width'=>$width,
            'height'=>$height,
            'title'=>$title
        );
        $status=$this->database->update_flash($data);
        if($status)
        {
            success('admin/flash','参数设置成功！');
        }else{
            error('参数设置失败！');
        }
    }

    public function update_flash_link(){
        $ID =$this->input->post('ID');
        $data=array(
            'url'=>$this->input->post('url')
        );
        $status=$this->database->update_flash_link($data,$ID);
        if($status)
        {
            success('admin/flash','参数设置成功！');
        }else{
            error('参数设置失败！');
        }


    }
}