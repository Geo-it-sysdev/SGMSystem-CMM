<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
     
   }

    //    Add / edit / delete - student
    public function get_all_students($grade_level = null, $section = null) {
        $user_id = $this->session->userdata('po_user');
        $user_type = $this->session->userdata('user_type'); 
    
        $this->db->select('*')->from('tbl_students');
    
        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            if (!$user_id) return [];
            $this->db->where('user_id', $user_id);
        }
    
        if ($grade_level) $this->db->where('grade_level', $grade_level);
        if ($section) $this->db->where('section', $section);
    
        return $this->db->get()->result();
    }
    

    public function get_sections_by_grade() {
        $grade_level = $this->input->get('grade_level');
        $user_id = $this->session->userdata('po_user');
    
        $this->db->select('DISTINCT section');
        $this->db->from('tbl_students');
        $this->db->where('user_id', $user_id);
        $this->db->where('grade_level', $grade_level);
        $query = $this->db->get()->result();
    
        $sections = array_map(function($row){ return $row->section; }, $query);
    
        echo json_encode($sections);
    }

    public function get_all_sections()
    {
        $this->db->select('classrooms_name, grade_level');
        $this->db->from('tbl_classrooms');
        $this->db->order_by('classrooms_name', 'ASC');
        return $this->db->get()->result();
    }

    public function get_grade_level_by_section($section)
    {
        $this->db->select('grade_level');
        $this->db->from('tbl_classrooms');
        $this->db->where('classrooms_name', $section);
        return $this->db->get()->row();
    }

    public function get_section_by_grade($grade_level)
    {
        $this->db->select('classrooms_name, grade_level');
        $this->db->from('tbl_classrooms');
        $this->db->where('grade_level', $grade_level);
        $this->db->order_by('classrooms_name', 'ASC');
        return $this->db->get()->result();
    }

    public function insert_student($data)
    {
        return $this->db->insert('tbl_students', $data);
    }

    public function get_student_by_id($id)
    {
        $user_id = $this->session->userdata('po_user');
        $this->db->where('user_id', $user_id); 
        return $this->db->get_where('tbl_students', ['id' => $id])->row();
    }

    public function update_student($id, $data)
    {
        $user_id = $this->session->userdata('po_user');
        $this->db->where('id', $id)->where('user_id', $user_id); 
        return $this->db->update('tbl_students', $data);
    }

    public function delete_student($id)
    {
        $user_id = $this->session->userdata('po_user');
        $this->db->where('id', $id)->where('user_id', $user_id); 
        return $this->db->delete('tbl_students');
    }

    public function check_duplicate($fullname, $gmail)
    {
        $this->db->group_start();
        if (!empty($fullname)) {
            $this->db->where('LOWER(TRIM(fullname)) =', strtolower(trim($fullname)));
        }
        if (!empty($gmail)) {
            $this->db->or_where('LOWER(TRIM(gmail)) =', strtolower(trim($gmail)));
        }
        $this->db->group_end();
        return $this->db->get('tbl_students')->num_rows() > 0;
    }

    public function check_duplicate_on_update($id, $fullname, $gmail)
    {
        $this->db->where('id !=', $id);
        $this->db->group_start();
        if (!empty($fullname)) {
            $this->db->where('LOWER(TRIM(fullname)) =', strtolower(trim($fullname)));
        }
        if (!empty($gmail)) {
            $this->db->or_where('LOWER(TRIM(gmail)) =', strtolower(trim($gmail)));
        }
        $this->db->group_end();
        return $this->db->get('tbl_students')->num_rows() > 0;
    }

    // end Add / edit / delete - student



 
    public function insert_activity($data) {
        return $this->db->insert('tbl_activity_type', $data);
    }

    
  

    // start crud classrooms
    public function get_all_classrooms() {
        return $this->db->get('tbl_classrooms')->result();
    }

    public function insert_classroom($data) {
        return $this->db->insert('tbl_classrooms', $data);
    }

    public function get_classroom($id) {
        return $this->db->get_where('tbl_classrooms', ['rooms_id' => $id])->row();
    }

    public function update_classroom($id, $data) {
        return $this->db->where('rooms_id', $id)->update('tbl_classrooms', $data);
    }

    public function check_duplicate_classroom($classroom_name, $id = null) {
        $this->db->where('classrooms_name', $classroom_name);
        if ($id) {
            $this->db->where('rooms_id !=', $id);
        }
        $query = $this->db->get('tbl_classrooms');
        return $query->num_rows() > 0;
    }
    

    public function delete_classroom($id) {
        return $this->db->delete('tbl_classrooms', ['rooms_id' => $id]);
    }
    // end crud classrooms


    public $table = 'tbl_activities_header';

    // Insert activity
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Update activity (only owner)
    public function update($id, $user_id, $data) {
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->update($this->table, $data);
    }

    // Delete activity (only owner)
    public function delete($id, $user_id) {
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->delete($this->table);
    }

    // Get activities by grade for this user
    public function get_by_grade($grade_level, $user_id = null) {
        $user_type = $this->session->userdata('user_type'); 
    
        $this->db->where('grade_level', $grade_level);
    
        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            if (!$user_id) return [];
            $this->db->where('user_id', $user_id);
        }
    
        return $this->db->order_by('id', 'DESC')->get($this->table)->result();
    }
    

    // Get single activity by ID
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id'=>$id])->row_array();
    }

    // Allowed subjects for a user
    public function get_user_subjects($user_id) {
        $this->db->select('subjects');
        $this->db->from('tbl_users');
        $this->db->where('id', $user_id);
        $row = $this->db->get()->row();
        return $row && !empty($row->subjects) ? array_map('trim', explode(',', $row->subjects)) : [];
    }

    // Allowed grades for a user
    public function get_user_grades($user_id) {
        $this->db->select('grades');
        $this->db->from('tbl_users');
        $this->db->where('id', $user_id);
        $row = $this->db->get()->row();
        return $row && !empty($row->grades) ? array_map('trim', explode(',', $row->grades)) : [];
    }


    public function count_activity_type($grade_level, $subject, $quarter, $activity_type){
        $this->db->like('activity_type', $activity_type, 'after'); // Match Quiz, Assignment, etc.
        $this->db->where('grade_level', $grade_level);
        $this->db->where('subject', $subject);
        $this->db->where('quarter', $quarter);
        return $this->db->count_all_results('tbl_activities_header');
    }
    
    
   
   // end add activities

   public function total_classrooms() {
        return $this->db->count_all('tbl_classrooms');
    }

    public function total_student($user_id = null)
    {
        $user_type = $this->session->userdata('user_type');
    
        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            if (!$user_id) return 0;
            $this->db->where('user_id', $user_id);
        }
    
        return $this->db->count_all_results('tbl_students');
    }
    


public function total_users() {
    return $this->db->count_all('tbl_users');
}


}