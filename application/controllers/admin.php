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
        $this->load->view('admin/flash.html',$data);
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
}