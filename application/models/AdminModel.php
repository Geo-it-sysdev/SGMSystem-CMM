<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
     
   }



public function is_user_name_exists_for_other($user_name, $id) {
    $this->db->where('user_name', $user_name);
    $this->db->where('id !=', $id); 
    $query = $this->db->get('tbl_users');
    return $query->num_rows() > 0;
}


public function get_pharma_users() {
    return $this->db->get('tbl_users')->result();
}

public function get_user_by_id($id)
{
    return $this->db->get_where('tbl_users', ['id' => $id])->row(); 
}

  //=============== User profile function ( view profile, update username & password ) ===============\\


public function update_per_user($user_id, $data){
    $this->db->where('id', $user_id);
    return $this->db->update('tbl_users', $data);
}

  //=============== Chat us function (chat & retrive chat) =====================\\

// public function get_all_users_with_unread_count($current_user_id) {
//     $this->db->select('pu.*, COUNT(cm.id) AS unread_count');
//     $this->db->from('tbl_users pu');
//     $this->db->join('chat_messages cm', 'cm.sender_id = pu.id AND cm.receiver_id = ' . $this->db->escape($current_user_id) . ' AND cm.is_read = 0', 'left');
//     $this->db->where('pu.id !=', $current_user_id); 
//     $this->db->group_by('pu.id');
//     return $this->db->get()->result();
// }

// public function get_chat_messages($sender_id, $receiver_id) {
//     $this->db->where("(sender_id = $sender_id AND receiver_id = $receiver_id) OR (sender_id = $receiver_id AND receiver_id = $sender_id)");
//     $this->db->order_by('timestamp', 'ASC');
//     return $this->db->get('chat_messages')->result();
// }

// public function insert_chat_message($data) {
//     return $this->db->insert('chat_messages', $data);
// }

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