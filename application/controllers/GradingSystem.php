<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_DB_query_builder $db */
class GradingSystem extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('AuthModel');
        $this->load->model('StudentModel');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');

    }
    
//=============== Check_log private function =====================\\
    private function check_log($user_select)
    {
        $user_id = $this->session->userdata("po_user");
        if (isset($user_id)) {
            $user = $this->AuthModel->get_user_by_user_id($user_id);
            $user_types_allow = array("Admin", "Principal", "Teacher", "Registrar", "Guidance Counselor");
            if (!in_array($user->user_type, $user_types_allow)) {
                $this->session->unset_userdata('po_user');
                redirect('AuthController/login_view');
            }

            if (!empty($user_select) && $user->user_type != "Manager") {
                if ($user_select != $user->user_type) {
                    redirect('GradingSystem/dashboard');
                }
            }
        } else {
            redirect('AuthController/login_view');
        }
    }
    //=============== Dashboard function =====================\\
	public function dashboard()
	{
        $user_id = $this->session->userdata("po_user");
     
         if (!$user_id) {
             redirect('AuthController/login_view');
             return;
         }
     
         // Load user profile
         $data['profile'] = $this->AdminModel->get_user($user_id);
         $data['total_classrooms'] = $this->StudentModel->total_classrooms();
         $data['total_student'] = $this->StudentModel->total_student($user_id);
         $data['total_users'] = $this->StudentModel->total_users();
        $this->check_log('');
		$this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/dashboard', $data);
        $this->load->view('template/footer');
	}



    public function student_setups() {
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }
    
       $data['profile'] = $this->AdminModel->get_user($user_id);
       $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('student/student_setups');
        $this->load->view('template/footer');
    }



    public function add_student() {
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }
    
       $data['profile'] = $this->AdminModel->get_user($user_id);
       $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('student/student_list');
        $this->load->view('template/footer');
    }

    public function my_students() {
        $user_id = $this->session->userdata("po_user");
        if (!$user_id) {
            redirect('AuthController/login_view');
            return;
        }
    
        $user = $this->AdminModel->get_user($user_id);
    
        if (!$user) {
            show_error("User not found.");
            return;
        }
        if (!empty($user->grades)) {
            $grades = array_map('trim', explode(',', $user->grades));
        } else {
            $grades = ['All'];
        }
        $data['grade_levels'] = $grades;
    
        $data['is_admin'] = ($user->user_type === 'admin');
    
        if ($user->user_type == 'Teacher') {
            $allowed_grades = $this->StudentModel->get_user_grades($user_id);
        } else {
            $allowed_grades = ['Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
        }
        $data['allowed_grades'] = $allowed_grades;
    
        $data['profile'] = $this->AdminModel->get_user($user_id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('student/my_students', $data);
        $this->load->view('template/footer');
    }
    
    public function classrooms() {
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }
  

        $data['profile'] = $this->AdminModel->get_user($user_id);
       $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('student/classrooms');
        $this->load->view('template/footer');
    }

    public function activity_student() {
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }
    
        // Get user allowed grades
        $this->db->select('grades, user_type');
        $this->db->from('tbl_users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $user = $query->row();
    
        if ($user && !empty($user->grades)) {
            $grades = array_map('trim', explode(',', $user->grades));
        } else {
            $grades = ['All'];
        }
    
        $data['grade_levels'] = $grades;
        $data['is_admin'] = ($user->user_type === 'admin'); 
       
        $user = $this->AdminModel->get_user($user_id);

        $allowed_grades = [];
    
        if($user && $user->user_type == 'Teacher'){
            $allowed_grades = $this->StudentModel->get_user_grades($user_id);
        } else {
            $allowed_grades = ['Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
        }
    
        $data['allowed_grades'] = $allowed_grades;
    
        $data['profile'] = $this->AdminModel->get_user($user_id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('student/activity_student', $data);
        $this->load->view('template/footer');
    }


    public function final_grades_student() {
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }
    
        // Get user allowed grades
        $this->db->select('grades, user_type');
        $this->db->from('tbl_users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $user = $query->row();
    
        if ($user && !empty($user->grades)) {
            $grades = array_map('trim', explode(',', $user->grades));
        } else {
            $grades = ['All'];
        }
    
        $data['grade_levels'] = $grades;
        $data['is_admin'] = ($user->user_type === 'admin'); // adjust as per your role field
    
        $data['profile'] = $this->AdminModel->get_user($user_id);
       $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('student/final_grades_student', $data);
        $this->load->view('template/footer');
    }

    public function user_list()
	{
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }
        // $data['users'] = $this->AdminModel->get_pharma_users();

        $data['profile'] = $this->AdminModel->get_user($user_id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('Admin/user_list');
        $this->load->view('template/footer');
	}

    
    public function final_average_student() {
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }
    
        // Get user allowed grades
        $this->db->select('grades, user_type');
        $this->db->from('tbl_users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $user = $query->row();
    
        if ($user && !empty($user->grades)) {
            $grades = array_map('trim', explode(',', $user->grades));
        } else {
            $grades = ['All'];
        }
    
        $data['grade_levels'] = $grades;
        $data['is_admin'] = ($user->user_type === 'admin'); // adjust as per your role field
    
        $data['profile'] = $this->AdminModel->get_user($user_id);
       $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('student/final_average_student', $data);
        $this->load->view('template/footer');
    }

    public function table()
	{
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }
        // $data['users'] = $this->AdminModel->get_pharma_users();

        $data['profile'] = $this->AdminModel->get_user($user_id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('Admin/table');
        $this->load->view('template/footer');
	}


    
    

    


}