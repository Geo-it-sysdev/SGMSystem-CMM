<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_DB_query_builder $db */
class StudentController extends CI_Controller {

	
	public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('StudentModel');
        $this->load->helper(['url', 'form']);
    }

   
    //    start add / edit / delete student
    public function fetch_students() {
        $grade_level = $this->input->get('grade_level');
        $section = $this->input->get('section'); 

        $students = $this->StudentModel->get_all_students($grade_level, $section);
        echo json_encode(['data' => $students]);
    }


    public function get_section_by_grade()
    {
        $grade = $this->input->get('grade_level');
        $data = $this->StudentModel->get_section_by_grade($grade);
        echo json_encode($data);
    }

    public function get_grade_level_by_section()
    {
        $section = $this->input->get('section');
        $data = $this->StudentModel->get_grade_level_by_section($section);
        echo json_encode($data);
    }

    public function edit_student($id)
    {
        $student = $this->StudentModel->get_student_by_id($id);
        if (!$student) {
            echo json_encode(['error' => 'Unauthorized or student not found']);
            return;
        }
        echo json_encode($student);
    }

    public function add_student()
    {
        $user_id = $this->session->userdata('po_user');
        $fullname = $this->input->post('fullname');
        $gmail = $this->input->post('gmail');

        if ($this->StudentModel->check_duplicate($fullname, $gmail)) {
            echo json_encode(['status' => 'duplicate']);
            return;
        }

        $data = [
            'user_id'     => $user_id,
            'fullname'    => $fullname,
            'age'         => $this->input->post('age'),
            'gender'      => $this->input->post('gender'),
            'section'     => $this->input->post('section'),
            'grade_level' => $this->input->post('grade_level'),
            'contact_no'  => $this->input->post('contact_no'),
            'gmail'       => $gmail
        ];

        $this->StudentModel->insert_student($data);
        echo json_encode(['status' => 'success']);
    }

    public function update_student()
    {
        $id = $this->input->post('id');
        $fullname = $this->input->post('fullname');
        $gmail = $this->input->post('gmail');

        if ($this->StudentModel->check_duplicate_on_update($id, $fullname, $gmail)) {
            echo json_encode(['status' => 'duplicate']);
            return;
        }

        $data = [
            'fullname'    => $fullname,
            'age'         => $this->input->post('age'),
            'gender'      => $this->input->post('gender'),
            'section'     => $this->input->post('section'),
            'grade_level' => $this->input->post('grade_level'),
            'contact_no'  => $this->input->post('contact_no'),
            'gmail'       => $gmail
        ];

        $updated = $this->StudentModel->update_student($id, $data);
        echo json_encode(['status' => $updated ? 'updated' : 'unauthorized']);
    }

    public function delete_student($id)
    {
        $deleted = $this->StudentModel->delete_student($id);
        echo json_encode(['status' => $deleted ? 'deleted' : 'unauthorized']);
    }

    public function make_inactive()
    {
        $ids = $this->input->post('ids');

        if(!$ids || !is_array($ids)) {
            echo json_encode(['status'=>'error','message'=>'No students selected']);
            return;
        }

        $this->db->where_in('id', $ids)
                ->update('tbl_students', ['status' => 'inactive']);

        if($this->db->affected_rows() > 0){
            echo json_encode(['status'=>'success']);
        } else {
            echo json_encode(['status'=>'error','message'=>'Update failed']);
        }
    }


    // end add / edit / delete student


    public function get_classrooms() {
        $search = $this->input->get('search');
        $this->db->select('classrooms_name');
        $this->db->from('tbl_classrooms');
        if (!empty($search)) {
            $this->db->like('classrooms_name', $search);
        }
        $query = $this->db->get();
        echo json_encode($query->result());
    }
    


    public function add_activity() {
        $data = array(
            'subject' => $this->input->post('subject'),
            'activity_type' => $this->input->post('activity_type'),
            'overall' => $this->input->post('overall'),
            'activity_date' => $this->input->post('activity_date')
        );

        $insert = $this->StudentModel->insert_activity($data);

        echo json_encode(['status' => $insert ? 'success' : 'error']);
    }

 
    
    // Get all sections
    public function get_sections()
    {
        $this->load->database();
    
        $grade_level = $this->input->get('grade_level');
        $user_id = $this->session->userdata('po_user'); 
    
        $this->db->where('user_id', $user_id);
    
        if (!empty($grade_level)) {
            $this->db->where('grade_level', $grade_level);
        }
    
        $sections = $this->db->select('section')
            ->distinct()
            ->get('tbl_students')
            ->result_array();
    
        echo json_encode(array_column($sections, 'section'));
    }
    

    public function get_students_by_section()
    {
        $section = $this->input->get('section');
        $activity_type_id = $this->input->get('activity_type_id');
        $user_id = $this->session->userdata('po_user'); 

        $graded = $this->db->select('user_id')
                        ->where('activities_id_header', $activity_type_id)
                        ->get('tbl_activities_lines')
                        ->result_array();

        $graded_ids = array_column($graded, 'user_id');

        $this->db->select('id, fullname, section, gender')
                ->where('section', $section)
                ->where('user_id', $user_id);

        if (!empty($graded_ids)) {
            $this->db->where_not_in('id', $graded_ids);
        }

        $students = $this->db->get('tbl_students')->result_array();

        echo json_encode($students);
    }


    // ✅ Save Grade
    public function save_grade_bulk()
    {
        $activity_type_id = $this->input->post('activity_type_id');
        $section = $this->input->post('section');
        $scores = $this->input->post('scores'); 

        if (!is_array($scores) || empty($scores)) {
            echo json_encode(['status' => 'error', 'message' => 'No scores submitted.']);
            return;
        }

        $activity = $this->db->where('id', $activity_type_id)
                            ->get('tbl_activities_header')
                            ->row();
        if (!$activity) {
            echo json_encode(['status' => 'error', 'message' => 'Activity not found.']);
            return;
        }
        $overall = $activity->overall;

        foreach ($scores as $student_id => $score) {

            if ($score === "" || $score === null) {
                continue; 
            }

            if ($score > $overall) {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Score for student exceeds the maximum allowed ({$overall})."
                ]);
                return;
            }

            $exist = $this->db->where([
                'activities_id_header' => $activity_type_id,
                'user_id' => $student_id
            ])->get('tbl_activities_lines')->row();

            if ($exist) {
                continue; 
            }

            $student = $this->db->where('id', $student_id)
                                ->get('tbl_students')
                                ->row();
            if (!$student) continue;

            $data = [
                'activities_id_header' => $activity_type_id,
                'user_id' => $student_id,
                'student_name' => $student->fullname,
                'section' => $student->section,
                'score' => $score,
                'date_created' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('tbl_activities_lines', $data);
        }

        echo json_encode(['status' => 'success']);
    }


    
    
    public function fetch_grades($activity_id)
    {
        $this->db->select("
            a.id,
            a.grade_level,
            a.subject,
            a.activity_type,
            a.overall,
            b.id AS line_id,
            b.student_name,
            b.section AS sections,
            b.score,
            b.remarks
        ");
        $this->db->from('tbl_activities_header AS a');
        $this->db->join('tbl_activities_lines AS b', 'b.activities_id_header = a.id', 'left');
        $this->db->where('a.id', $activity_id);
        $query = $this->db->get();
    
        echo json_encode($query->result());
    }

    public function update_grade() {
        $id = $this->input->post('grade_id');
        $data = [
            'section' => $this->input->post('section'),
            'score' => $this->input->post('score')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_activities_lines', $data);
        echo json_encode(['status' => true]);
    }

    public function delete_grade($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_activities_lines');
        echo json_encode(['status' => true]);
    }


    // cruds classrooms start
    public function fetch_classrooms() {
        $data = $this->StudentModel->get_all_classrooms();
        echo json_encode(['data' => $data]);
    }

    public function save_classroom() {
        $id = $this->input->post('rooms_id');
        $classroom_name = trim($this->input->post('classrooms_name', true));
        $grade_level = $this->input->post('grade_level', true);
        $description = $this->input->post('description', true);
    
        $exists = $this->StudentModel->check_duplicate_classroom($classroom_name, $id);
    
        if ($exists) {
            echo json_encode(['status' => 'duplicate']);
            return;
        }
    
        $data = array(
            'classrooms_name' => $classroom_name,
            'grade_level' => $grade_level,
            'description' => $description
        );
    
        if (empty($id)) {
            $result = $this->StudentModel->insert_classroom($data);
        } else {
            $result = $this->StudentModel->update_classroom($id, $data);
        }
    
        echo json_encode(['status' => $result ? 'success' : 'error']);
    }
    

    public function get_classroom_by_id($id) {
        $data = $this->StudentModel->get_classroom($id);
        echo json_encode($data);
    }

    public function delete_classroom($id) {
        $delete = $this->StudentModel->delete_classroom($id);
        echo json_encode(['status' => $delete ? 'success' : 'error']);
    }

    // end crud classrooms 

  

    public $table = 'tbl_activities_header';
    // Allowed grades for current user
    public function get_allowed_grades() {
        $user_id = $this->session->userdata("po_user");
        $user_type = $this->session->userdata("user_type");
        $grades = $user_type === 'Teacher' 
            ? $this->StudentModel->get_user_grades($user_id) 
            : ['Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
        echo json_encode($grades);
    }

    // Allowed subjects for current user
    public function get_allowed_subjects() {
        $user_id = $this->session->userdata("po_user");
        $subjects = $this->StudentModel->get_user_subjects($user_id);
        echo json_encode($subjects);
    }

    // Fetch activities by grade
    public function fetch_activitie() {
        $grade_level = $this->input->post('grade_level');
        $user_id = $this->session->userdata('po_user');
        $data = $this->StudentModel->get_by_grade($grade_level, $user_id);
        echo json_encode(['data'=>$data]);
    }

    public function save_activity() {
        $id = $this->input->post('id');
        $user_id = $this->session->userdata("po_user");
        $user_type = $this->session->userdata("user_type");
        $grade_level = $this->input->post('grade_level'); // e.g., "Grade 7", "Grade 11"
        $subject = $this->input->post('subject');
        $quarter = $this->input->post('quarter');
        $activity_type = $this->input->post('activity_type');

        // Junior High subjects
        $gradeSubjects = [
            "Grade 7" => ["Filipino", "English", "Mathematics", "Science", "Araling Panlipunan", "MAPEH", "ESP", "TLE"],
            "Grade 8" => ["Filipino", "English", "Mathematics", "Science", "Araling Panlipunan", "MAPEH", "ESP", "TLE"],
            "Grade 9" => ["Filipino", "English", "Mathematics", "Science", "Araling Panlipunan", "MAPEH", "ESP", "TLE"],
            "Grade 10" => ["Filipino", "English", "Mathematics", "Science", "Araling Panlipunan", "MAPEH", "ESP", "TLE"]
        ];

        // Senior High Core and Strand Subjects
        $strandSubjects = [
            "ICT" => ["Computer Systems Servicing (CSS)", "Programming", "Data Communication", "Computer Networking"],
            "ABM" => ["Business Math", "Business Finance", "Organization & Management", "Principles of Marketing", "Applied Economics", "Business Ethics & Social Responsibility"],
            "HUMSS" => ["Creative Writing", "Creative Nonfiction", "Introduction to World Religions", "Philippine Politics and Governance", "Social Science 1", "Social Science 2"],
            "STEM_A" => ["Pre-Calculus", "Basic Calculus", "General Biology 1", "General Biology 2", "General Physics 1", "General Physics 2", "General Chemistry 1", "General Chemistry 2"],
            "INDUSTRIAL_ARTS" => ["Welding", "Automotive Servicing", "Electrical Installation", "Carpentry"],
            "HOME_ECONOMICS" => ["Cookery", "Bread & Pastry", "Housekeeping", "Food & Beverage Services"],
            "Common" => [
                "Oral Communication","Reading and Writing","Komunikasyon at Pananaliksik","Pagbasa at Pagsusuri",
                "21st Century Literature","Contemporary Philippine Arts","Media and Information Literacy",
                "General Mathematics","Statistics and Probability","Earth and Life Science","Physical Science",
                "Personal Development","Understanding Culture Society and Politics","Physical Education & Health (PEH)",
                "Empowerment Technologies (E-Tech)","Filipino sa Piling Larangan","Practical Research 1",
                "Practical Research 2","Inquiries Investigations & Immersion","Entrepreneurship"
            ]
        ];

        // Merge all SHS subjects for validation
        $allSHSSubjects = [];
        foreach($strandSubjects as $strand => $subjects){
            $allSHSSubjects = array_merge($allSHSSubjects, $subjects);
        }

        // Validation
        if(isset($gradeSubjects[$grade_level])) {
            // Junior High
            if(!in_array($subject, $gradeSubjects[$grade_level])) {
                echo json_encode(['status'=>false, 'message'=>'Selected subject does not match the grade.']);
                return;
            }
        } elseif(in_array($grade_level, ["Grade 11", "Grade 12"])) {
            // Senior High
            if(!in_array($subject, $allSHSSubjects)) {
                echo json_encode(['status'=>false, 'message'=>'Selected subject does not match Grade 11/12 subjects.']);
                return;
            }
        } else {
            echo json_encode(['status'=>false, 'message'=>'Invalid grade level.']);
            return;
        }

        // Teacher permission check
        if($user_type === 'Teacher'){
            $allowed_subjects = $this->StudentModel->get_user_subjects($user_id);
            if(!in_array($subject, $allowed_subjects)){
                echo json_encode(['status'=>false,'message'=>'You are not allowed to save activity for this subject.']);
                return;
            }
        }

        // Handle duplicate activity type
        if (!$id) { // Only for new insert
            $count = $this->StudentModel->count_activity_type($grade_level, $subject, $quarter, $activity_type);
            $activity_type .= ' ' . ($count + 1);
        }

        // Prepare data
        $data = [
            'grade_level' => $grade_level,
            'quarter' => $quarter,
            'subject' => $subject,
            'activity_type' => $activity_type,
            'description' => $this->input->post('descrip'),
            'overall' => $this->input->post('overall'),
            'activity_date' => date('Y-m-d'),
            'user_id' => $user_id
        ];

        // Insert or update
        if($id){
            $result = $this->StudentModel->update($id, $user_id, $data);
            $msg = $result ? 'Activity updated successfully' : 'You cannot update this activity';
        } else {
            $result = $this->StudentModel->insert($data);
            $msg = $result ? 'Activity added successfully' : 'Failed to add activity';
        }

        echo json_encode(['status'=>$result,'message'=>$msg]);
    }



    // Get single activity for edit
    public function get_activity($id) {
        $user_id = $this->session->userdata('po_user');
        $activity = $this->StudentModel->get_by_id($id);
        if(!$activity || $activity['user_id'] != $user_id){
            echo json_encode(['status'=>false,'message'=>'Activity not found']);
            return;
        }
        echo json_encode($activity);
    }

    // Delete activity
    public function delete_activity($id) {
        $user_id = $this->session->userdata('po_user');
        $result = $this->StudentModel->delete($id, $user_id);
        echo json_encode(['status'=>$result]);
    }
    

  
  

    // final grades

    public function fetch_activities() {
        $grade_level = $this->input->post('grade_level'); 
        $user_id    = $this->session->userdata('po_user'); 
        $user_type  = $this->session->userdata('user_type'); 

        $this->db->select('a.id, a.subject, a.grade_level, a.quarter, b.full_name, c.section, a.activity_date');
        $this->db->from('tbl_activities_header AS a');
        $this->db->join('tbl_activities_lines AS c', 'c.activities_id_header = a.id', 'left');
        $this->db->join('tbl_users AS b', 'b.id = a.user_id', 'left');

        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            if (!$user_id) {
                echo json_encode(['data' => []]);
                return;
            }
            $this->db->where('a.user_id', $user_id);
        }

        if ($grade_level && $grade_level != '') {
            $this->db->where('a.grade_level', $grade_level);
        }

        $this->db->group_by(['a.subject', 'a.quarter', 'c.section', 'b.full_name']);
        $query = $this->db->get()->result();

        $data = [];
        foreach ($query as $row) {
            $data[] = [
                'id'          => $row->id,
                'grade_level' => $row->grade_level,
                'subject'     => $row->subject,
                'full_name'   => $row->full_name,
                'section'     => $row->section,
                'quarter'     => $row->quarter
            ];
        }

        echo json_encode(['data' => $data]);
    }




    public function fetch_final_grades() {
        $section     = $this->input->post('section');
        $subject     = $this->input->post('subject');
        $quarter     = $this->input->post('quarter');
        $grade_level = $this->input->post('grade_level');
        $user_id     = $this->session->userdata('po_user');      
        $user_type   = $this->session->userdata('user_type');   

        if (in_array($grade_level, ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'])) {
            $weight_WW = 0.30;
            $weight_PT = 0.50;
            $weight_QA = 0.20;
        } else { // Grade 11–12
            $weight_WW = 0.25;
            $weight_PT = 0.50;
            $weight_QA = 0.25;
        }

        $this->db->select('a.id, a.description AS activity_type, a.overall AS overall_score, b.student_name, b.score, b.section, b.user_id AS student_id, c.full_name');
        $this->db->from('tbl_activities_header AS a');
        $this->db->join('tbl_activities_lines AS b', 'b.activities_id_header = a.id', 'left');
        $this->db->join('tbl_users AS c', 'c.id = a.user_id', 'left');
        $this->db->where('a.subject', $subject);
        $this->db->where('a.quarter', $quarter);
        $this->db->where('a.grade_level', $grade_level);
        $this->db->where('b.section', $section);

        // Only filter by user_id if the user is NOT Principal, Registrar, or Guidance Councilor
        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            $this->db->where('a.user_id', $user_id);
        }

        $query = $this->db->get()->result();

        $students = [];

        foreach ($query as $row) {
            $name = $row->student_name;

            if (!isset($students[$name])) {
                $students[$name] = [
                    'WW_total' => 0, 'WW_count' => 0, 'WW_overall' => 0,
                    'PT_total' => 0, 'PT_count' => 0, 'PT_overall' => 0,
                    'QA_total' => 0, 'QA_count' => 0, 'QA_overall' => 0
                ];
            }

            if ($row->activity_type == 'Written Works') {
                $students[$name]['WW_total'] += $row->score;
                $students[$name]['WW_overall'] += $row->overall_score;
                $students[$name]['WW_count']++;
            } elseif ($row->activity_type == 'Performance Task') {
                $students[$name]['PT_total'] += $row->score;
                $students[$name]['PT_overall'] += $row->overall_score;
                $students[$name]['PT_count']++;
            } elseif ($row->activity_type == 'Quarterly Assessment') {
                $students[$name]['QA_total'] += $row->score;
                $students[$name]['QA_overall'] += $row->overall_score;
                $students[$name]['QA_count']++;
            }
        }

        $data = [];

        foreach ($students as $student_name => $scores) {
            $ww_percent = $scores['WW_overall'] ? ($scores['WW_total'] / $scores['WW_overall'] * 100) : 0;
            $pt_percent = $scores['PT_overall'] ? ($scores['PT_total'] / $scores['PT_overall'] * 100) : 0;
            $qa_percent = $scores['QA_overall'] ? ($scores['QA_total'] / $scores['QA_overall'] * 100) : 0;

            $final_grade = ($ww_percent * $weight_WW) +
                        ($pt_percent * $weight_PT) +
                        ($qa_percent * $weight_QA);

            if ($final_grade >= 90) {
                $rating = '1.00'; $remarks = 'Outstanding';
            } elseif ($final_grade >= 85) {
                $rating = '1.25'; $remarks = 'Very Satisfactory';
            } elseif ($final_grade >= 80) {
                $rating = '1.50'; $remarks = 'Very Satisfactory';
            } elseif ($final_grade >= 75) {
                $rating = '1.75'; $remarks = 'Satisfactory';
            } elseif ($final_grade >= 70) {
                $rating = '2.00'; $remarks = 'Satisfactory';
            } elseif ($final_grade >= 65) {
                $rating = '2.25'; $remarks = 'Fair';
            } elseif ($final_grade >= 60) {
                $rating = '2.50'; $remarks = 'Fair';
            } elseif ($final_grade >= 55) {
                $rating = '2.75'; $remarks = 'Did Not Meet Expectations';
            } elseif ($final_grade >= 50) {
                $rating = '3.00'; $remarks = 'Did Not Meet Expectations';
            } else {
                $rating = '5.00'; $remarks = 'Failure';
            }

            $section_name = $query[0]->section ?? '';

            $data[] = [
                'student_name' => $student_name,
                'section'      => $section_name,
                'final_grade'  => round($final_grade, 2),
                'depEd_rating' => $rating,
                'remarks'      => $remarks
            ];
        }

        echo json_encode(['data' => $data]);
    }



    public function fetch_student_details() {
        $student_name = $this->input->post('student_name');
        $section = $this->input->post('section');
        $subject = $this->input->post('subject');
        $quarter = $this->input->post('quarter');
        $grade_level = $this->input->post('grade_level');

        $this->db->select('a.activity_date,
                        a.activity_type, 
                        a.description, 
                        a.grade_level, 
                        a.overall, 
                        b.score,
                        b.section,
                        c.full_name AS teacher,
                        CONCAT(FORMAT((b.score/a.overall*100), 2), "%") AS ratings,
                        IF((b.score/a.overall*100) >= 75, "Passed", "Failed") AS remarks');
        $this->db->from('tbl_activities_header AS a');
        $this->db->join('tbl_activities_lines AS b', 'b.activities_id_header = a.id', 'left');
        $this->db->join('tbl_users AS c', 'c.id = a.user_id', 'left');
        $this->db->where('a.subject', $subject);
        $this->db->where('a.quarter', $quarter);
        $this->db->where('a.grade_level', $grade_level);
        $this->db->where('b.section', $section);
        $this->db->where('b.student_name', $student_name);

        $query = $this->db->get()->result();

        echo json_encode(['data' => $query]);
    }


    public function upload_profile_photo()
    {
        $user_id = $this->input->post('user_id');

        // Fetch old photo
        $old = $this->db->where('id', $user_id)->get('tbl_users')->row();
        $old_photo = $old ? $old->photo : null;

        // Upload config
        $config['upload_path'] = './assets/images/users/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {
            echo json_encode([
                'status' => 'error',
                'message' => $this->upload->display_errors()
            ]);
            return;
        }

        // Success
        $upload_data = $this->upload->data();
        $new_filename = 'assets/images/users/' . $upload_data['file_name'];

        if (!empty($old_photo) && file_exists('./' . $old_photo)) {
            if ($old_photo != 'assets/img/user-dummy-img.jpg') {
                unlink('./' . $old_photo);
            }
        }

        // Update DB
        $this->db->where('id', $user_id);
        $this->db->update('tbl_users', ['photo' => $new_filename]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Profile photo updated.',
            'new_photo' => base_url($new_filename)
        ]);
    }



    // Fetch activities per grade
    public function fetch_activity_by_grade() {
        $grade_level = $this->input->post('grade_level');
        $user_id     = $this->session->userdata('po_user');
        $user_type   = $this->session->userdata('user_type'); 

        $this->db->select('a.grade_level, b.section, c.full_name');
        $this->db->from('tbl_activities_header AS a');
        $this->db->join('tbl_activities_lines AS b', 'b.activities_id_header = a.id', 'left');
        $this->db->join('tbl_users AS c', 'c.id = a.user_id', 'left');

        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            $this->db->where('a.user_id', $user_id);
        }

        if (!empty($grade_level)) {
            $this->db->where('a.grade_level', $grade_level);
        }

        $this->db->group_by('b.section');

        echo json_encode(['data' => $this->db->get()->result()]);
    }


    // Fetch students by section
    public function fetch_students_by_section() {
        $section   = $this->input->post('section');
        $user_id   = $this->session->userdata('po_user');     
        $user_type = $this->session->userdata('user_type');   

        $this->db->select('b.student_name, b.section, a.grade_level, c.full_name AS teacher');
        $this->db->from('tbl_activities_header AS a');
        $this->db->join('tbl_activities_lines AS b', 'b.activities_id_header = a.id', 'left');
        $this->db->join('tbl_users AS c', 'c.id = a.user_id', 'left');

        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            $this->db->where('a.user_id', $user_id);
        }

        if (!empty($section)) {
            $this->db->where('b.section', $section);
        }

        $this->db->group_by('b.student_name');

        echo json_encode(['data' => $this->db->get()->result()]);
    }



    // Fetch per-student grades for modal
    public function fetch_final_average() {
        $student_name = $this->input->post('student_name');
        $grade_level  = $this->input->post('grade_level');
        $section      = $this->input->post('section');
        $user_id      = $this->session->userdata('po_user');      
        $user_type    = $this->session->userdata('user_type');   

        // Weight rules
        if (in_array($grade_level, ['Grade 7','Grade 8','Grade 9','Grade 10'])) {
            $weight_WW = 0.30; 
            $weight_PT = 0.50; 
            $weight_QA = 0.20;
        } else {
            $weight_WW = 0.25; 
            $weight_PT = 0.50; 
            $weight_QA = 0.25;
        }

        // Fetch all activities for this student
        $this->db->select('a.subject, a.quarter, a.description AS activity_type, a.overall AS overall_score, b.score, c.full_name AS teacher');
        $this->db->from('tbl_activities_header AS a');
        $this->db->join('tbl_activities_lines AS b','b.activities_id_header = a.id','left');
        $this->db->join('tbl_users AS c','c.id = a.user_id','left');
        $this->db->where('a.grade_level', $grade_level);
        $this->db->where('b.student_name', $student_name);
        $this->db->where('b.section', $section);

        // Apply user filter only if user is NOT Principal, Registrar, or Guidance Councilor
        if (!in_array($user_type, ['Principal', 'Registrar', 'Guidance Councilor'])) {
            $this->db->where('a.user_id', $user_id);
        }

        $query = $this->db->get()->result();

        $subjects = [];

        // Organize activities by subject and type
        foreach($query as $row){
            if(!isset($subjects[$row->subject])){
                $subjects[$row->subject] = ['WW'=>[],'PT'=>[],'QA'=>[]];
            }
            switch($row->activity_type){
                case 'Written Works': $subjects[$row->subject]['WW'][] = $row; break;
                case 'Performance Task': $subjects[$row->subject]['PT'][] = $row; break;
                case 'Quarterly Assessment': $subjects[$row->subject]['QA'][] = $row; break;
            }
        }

        $data = [];

        // Loop per subject
        foreach($subjects as $subject => $subData){
            $finalGradesPerQuarter = [];

            foreach(['1st Quarter','2nd Quarter','3rd Quarter','4th Quarter'] as $quarter){
                // Written Works
                $WW_total = $WW_overall = 0;
                foreach($subData['WW'] as $w){
                    if($w->quarter == $quarter){
                        $WW_total += $w->score;
                        $WW_overall += $w->overall_score;
                    }
                }
                $WW_percent = $WW_overall ? ($WW_total/$WW_overall*100) : 0;

                // Performance Task
                $PT_total = $PT_overall = 0;
                foreach($subData['PT'] as $p){
                    if($p->quarter == $quarter){
                        $PT_total += $p->score;
                        $PT_overall += $p->overall_score;
                    }
                }
                $PT_percent = $PT_overall ? ($PT_total/$PT_overall*100) : 0;

                // Quarterly Assessment
                $QA_total = $QA_overall = 0;
                foreach($subData['QA'] as $qTask){
                    if($qTask->quarter == $quarter){
                        $QA_total += $qTask->score;
                        $QA_overall += $qTask->overall_score;
                    }
                }
                $QA_percent = $QA_overall ? ($QA_total/$QA_overall*100) : 0;

                // Final grade for this quarter
                $finalQuarter = ($WW_percent*$weight_WW)+($PT_percent*$weight_PT)+($QA_percent*$weight_QA);
                $finalGradesPerQuarter[] = round($finalQuarter,2);
            }

            // Add subject only if it has grades for a semester
            $hasFirstSem = ($finalGradesPerQuarter[0] > 0 || $finalGradesPerQuarter[1] > 0);
            $hasSecondSem = ($finalGradesPerQuarter[2] > 0 || $finalGradesPerQuarter[3] > 0);

            if($hasFirstSem || $hasSecondSem){
                $data[] = [
                    'subject' => $subject,
                    'q1' => $finalGradesPerQuarter[0],
                    'q2' => $finalGradesPerQuarter[1],
                    'q3' => $finalGradesPerQuarter[2],
                    'q4' => $finalGradesPerQuarter[3],
                    'final_grade' => round(array_sum($finalGradesPerQuarter)/4,2)
                ];
            }
        }

        echo json_encode(['data'=>$data]);
    }


}