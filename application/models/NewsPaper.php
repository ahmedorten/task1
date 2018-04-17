<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NewsPaper extends CI_Model{
    /*
     * Get News
     */
    function getRows($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('news', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('news');
            return $query->result_array();
        }
    }

    /*
     * Insert News
     */
    public function insert($data = array()) {
        $insert = $this->db->insert('news', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /*
     * Update news
     */
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('news', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    /*
     * Delete news
     */
    public function delete($id){
        $delete = $this->db->delete('news',array('id'=>$id));
        return $delete?true:false;
    }
}