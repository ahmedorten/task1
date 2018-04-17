<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
    /*
     * Get Users
     */
    function getRows($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }

    /*
     * Insert User
     */
    public function insert($data = array()) {
        $insert = $this->db->insert('users', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /*
     * Update User
     */
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('users', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    /*
     * Delete User
     */
    public function delete($id){
        $delete = $this->db->delete('users',array('id'=>$id));
        return $delete?true:false;
    }

    public function validate(){
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password',md5($this->input->post('password')));
        $query = $this->db->get('users');

        if($query->num_rows() == 1)
        {
            return true;
        }else{
            return false;
        }
    }
}