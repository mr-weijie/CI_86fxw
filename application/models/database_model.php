<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/28
 * Time: 13:41
 */
class Database_model extends CI_Model{
    public function getsysinfo(){
       $data=$this->db->get('sysinfo')->result_array();
       return $data;
    }
    public function getflash(){
        $data['pics']=$this->db->where(array('rectype'=>'pic'))->get('flash')->result_array();
        $data['window']=$this->db->where(array('rectype'=>'window'))->get('flash')->result_array();
        return $data;
    }
    public function getprice_nav(){
        $data=$this->db->select('content')->where(array('rectype'=>'price_nav'))-> get('content')->result_array();
        return $data;

    }

    public function getindex_con(){
        $data['产品中心']=$this->db->select('content,url')->where(array('rectype'=>'index_con','title'=>'产品中心'))-> get('content')->result_array();
        $data['服务定制']=$this->db->select('content,url')->where(array('rectype'=>'index_con','title'=>'服务定制'))-> get('content')->result_array();
        $data['代理招商']=$this->db->select('content,url')->where(array('rectype'=>'index_con','title'=>'代理招商'))-> get('content')->result_array();
        $data['成功案例']=$this->db->select('content,url')->where(array('rectype'=>'index_con','title'=>'成功案例'))-> get('content')->result_array();
        $data['产品价格']=$this->db->select('content,url')->where(array('rectype'=>'index_con','title'=>'产品价格'))-> get('content')->result_array();
        $data['常见问题']=$this->db->select('content,url')->where(array('rectype'=>'index_con','title'=>'常见问题'))-> get('content')->result_array();
        return $data;

    }
    public function getinfo($con){
        $data=$this->db->select('content,url')->where(array('rectype'=>$con))-> get('content')->result_array();
        return $data;

    }
    public function getnewslist(){
        $data=$this->db->select('rowid,title,addDate,modDate,author,source,clicks')->where(array('rectype'=>'news'))-> get('content')->result_array();
        return $data;

    }
    public function getnews($rowid){
        $data=$this->db->where(array('rowid'=>$rowid))->get('content')->result_array();
        return $data;
    }
    public function getproducts(){
        $data=$this->db->select('rowid,title,profile,pics')->get('products')->result_array();
        return $data;

    }
    public function getproduct($rowid){
        $data=$this->db->select('title,pics,content')->where(array('rowid'=>$rowid))->get('products')->result_array();
        return $data;
    }
    public function uploadfile($pid,$photofile){
        $data=$this->db->update('flash', array('pic'=>$photofile),array('id'=>$pid));
        return $data;

    }
}