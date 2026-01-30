<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
     
   }

    //    Add / edit / delete - student
   public function get_all_students($grade_level = null, $section = null, $status = 'active')
{
    $user_id   = $this->session->userdata('po_user');
    $user_type = $this->session->userdata('user_type');

    $this->db->select('a.id, a.fullname, a.age, a.gender, a.section, a.grade_level, a.user_id, a.created_at AS school_year, a.status, b.student_id, b.user_id AS teacher_id')
             ->from('tbl_students AS a')
             ->join('tbl_tag_students AS b', 'b.student_id = a.id', 'left');

    // Restrict access for non-admin users
    if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Counselor', 'Admin'])) {
        if (!$user_id) return [];
        if ($user_type === 'Teacher') {
            $this->db->where('b.user_id', $user_id)
                     ->where('b.status', 'active');
        } else {
            $this->db->where('a.user_id', $user_id);
        }
    }

    if ($grade_level) {
        $this->db->where('a.grade_level', $grade_level);
    }

    if ($section) {
        if (is_array($section)) {
            $this->db->where_in('a.section', $section);
        } else {
            $this->db->where('a.section', $section);
        }
    }

    $this->db->where('a.status', $status ?: 'active');
    $this->db->group_by('a.fullname');

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
    // Fetch student by ID only, no session restriction
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

   public function check_duplicate($fullname)
    {
        if (empty($fullname)) return false;

        $this->db->where('LOWER(TRIM(fullname)) =', strtolower(trim($fullname)));
        return $this->db->get('tbl_students')->num_rows() > 0;
    }

    public function check_duplicate_on_update($id, $fullname)
    {
        $this->db->where('id !=', $id);

        if (!empty($fullname)) {
            $this->db->where('LOWER(TRIM(fullname)) =', strtolower(trim($fullname)));
        }

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

    public function delete_activity($id, $user_id) {
        $this->db->trans_start();

        $this->db->where('activities_id_header', $id);
        $this->db->delete('tbl_activities_lines');

        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->delete($this->table);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }



   public function get_by_grade($grade_level, $user_id = null)
    {
        $user_type = $this->session->userdata('user_type');

        // Use session user if no user_id is provided
        if (!$user_id) {
            $user_id = $this->session->userdata("po_user");
        }

        $this->db->select("a.*,
            (
                SELECT COUNT(s.id)
                FROM tbl_students s
                INNER JOIN tbl_tag_students t ON t.student_id = s.id
                WHERE s.grade_level = a.grade_level
                AND t.user_id = {$user_id}  
                AND t.status = 'active'  
                AND NOT EXISTS (
                    SELECT 1
                    FROM tbl_activities_lines l
                    WHERE l.student_id = s.id
                        AND l.activities_id_header = a.id
                )
            ) AS pending_count
        ");
        $this->db->from("tbl_activities_header a");
        $this->db->where("a.grade_level", $grade_level);

        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            $this->db->where('a.user_id', $user_id);
        }

        $this->db->order_by("a.id", "DESC");
        return $this->db->get()->result();
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
        $this->db->like('activity_type', $activity_type, 'after'); 
        $this->db->where('grade_level', $grade_level);
        $this->db->where('subject', $subject);
        $this->db->where('quarter', $quarter);
        return $this->db->count_all_results('tbl_activities_header');
    }
   // end add activities


   // Dashboard counts
   public function total_classrooms() {
    return $this->db->count_all('tbl_classrooms');
   }

    public function total_student(){
        return $this->db->count_all_results('tbl_students');
    }

    public function total_users() {
        return $this->db->count_all('tbl_users');
    }
    // end Dashboard counts

}