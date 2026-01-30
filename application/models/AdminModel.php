<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
     
   }




    public function update_per_user($user_id, $data){
        $this->db->where('id', $user_id);
        return $this->db->update('tbl_users', $data);
    }


    // add user setup
    public function get_all_users() {
        return $this->db->get('tbl_users')->result();
    }

    public function insert_user($data) {
        return $this->db->insert('tbl_users', $data);
    }

    public function is_user_name_exists($user_name) {
        $query = $this->db->get_where('tbl_users', ['user_name' => $user_name]);
        return $query->num_rows() > 0;
    }

    public function get_user($id) {
        return $this->db->get_where('tbl_users', ['id' => $id])->row();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_users', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_users');
    }
    // endd add user setup


    public function get_today_events()
    {
        $this->db->select('description');
        $this->db->from('tbl_upcoming_events');
        $this->db->where('DATE(event_date)', date('Y-m-d'));
        return $this->db->get()->result();
    }


}