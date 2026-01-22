
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
     
   }
   public function get_user_by_username($username) {
    $this->db->where('user_name', $username);
    $query = $this->db->get('tbl_users');
    return $query->row(); 
    }

    public function get_user_by_user_id($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('tbl_users');
        return $query->row(); 
    }


 
    
    


  
    

}

