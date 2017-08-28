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
        $data=$this->db->get('flash')->result_array();
        return $data;
    }
    public function getinfo($con){
        $data=$this->db->where(array('rectype'=>$con))-> get('content')->result_array();
        foreach($data as $item):
            $info[$item['title']]['content']=$item['content'];
            $info[$item['title']]['url']=$item['url'];
        endforeach;
        return $info;

    }

}