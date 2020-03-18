<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Co_model extends CI_Model {

    function getMenuArray($user_type){
        $menu_arr = array();
        $menu_permitted = $this->db->select('menu_permitted')->where('level_id',$user_type)->get('level_user_type')->row('menu_permitted');
        if($menu_permitted != ''){
            $menu_permitted = str_replace("[","",$menu_permitted);
            $menu_permitted = str_replace("]","",$menu_permitted);
            $this->db->where("menu_id IN(" . $menu_permitted . ")");
        }
        
        $query = $this->db->where('status','yes')->where('parent_id','#')->order_by('menu_order')->get('menu');
        foreach ($query->result_array() as $res){
            $menu_arr[$res['menu_id']] = $res;
            $menu_arr[$res['menu_id']]['sub'] = $this->getSubMenuArray($res['menu_id'],$menu_permitted);
            
        }
        return $menu_arr;
        
    }
    
    function getSubMenuArray($parent_id,$menu_permitted){
        $menu_arr = array();
        if($menu_permitted != ''){
            $menu_permitted = str_replace("[","",$menu_permitted);
            $menu_permitted = str_replace("]","",$menu_permitted);
            $this->db->where("menu_id IN(" . $menu_permitted . ")");
        }
        $query = $this->db->where('status','yes')->where('parent_id',$parent_id)->order_by('menu_order')->get('menu');
        foreach ($query->result_array() as $res){
            $menu_arr[$res['menu_id']] = $res;
            $menu_arr[$res['menu_id']]['menu'] = 'sub';
        }
        return $menu_arr;
    }

}