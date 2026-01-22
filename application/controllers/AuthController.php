<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('AdminModel');
        $this->load->library('session');
        $this->load->helper('url');

       
    }
	public function login_view()
	{
        $this->check_log();
        $this->load->view('template/login_view');
	}

    private function check_log()
    {
        $user_id = $this->session->userdata("po_user");
        if (isset($user_id)) {
            $user = $this->AuthModel->get_user_by_user_id($user_id);
            if ($user->user_type == 'Admin') {
                redirect('GradingSystem/dashboard');

            // } elseif ($user->user_type == 'Corporate Manager') {
            //     redirect('AdminController/dashboard');

            } else {
                redirect('GradingSystem/dashboard');
            }

        }
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->AuthModel->get_user_by_username($username);
    
        if ($user) {
            // Check if user is inactive
            if ($user->status === 'Inactive') {
                $this->session->set_flashdata('swal_error', 'Your account is inactive. Please contact admin.');
                redirect('AuthController/login_view');
                return;
            }
    
            // Verify password
            if (password_verify($password, $user->password)) {
                // ✅ Store base session data
                $this->session->set_userdata("po_user", $user->id);
    
                // Fetch user details (including user_type and grades)
                $userDetails = $this->AuthModel->get_user_by_user_id($user->id);
    
                if ($userDetails) {
                    // ✅ Store all necessary data in session
                    $this->session->set_userdata('user_full_name', $userDetails->full_name);
                    $this->session->set_userdata('user_type', $userDetails->user_type);
                    $this->session->set_userdata('grades', $userDetails->grades); // example: "Grade 7, Grade 8"
    
                    // Greeting logic
                    date_default_timezone_set('Asia/Manila');
                    $hour = (int) date('H');
                    if ($hour >= 5 && $hour < 12) {
                        $greeting = 'Good morning';
                    } elseif ($hour >= 12 && $hour < 17) {
                        $greeting = 'Good afternoon';
                    } elseif ($hour >= 17 && $hour < 21) {
                        $greeting = 'Good evening';
                    } else {
                        $greeting = 'Good night';
                    }
    
                    $this->session->set_flashdata('greeting', "$greeting, {$userDetails->full_name}");
    
                    // Continue to main dashboard or check logs
                    $this->check_log();
                } else {
                    $this->session->set_flashdata('swal_error', 'User details not found');
                    redirect('AuthController/login_view');
                    return;
                }
    
            } else {
                $this->session->set_flashdata('swal_error', 'Invalid username or password');
                redirect('AuthController/login_view');
            }
        } else {
            $this->session->set_flashdata('swal_error', 'Invalid username or password');
            redirect('AuthController/login_view');
        }
    }
    

    public function logout() {
        $this->session->unset_userdata('po_user');
        redirect('AuthController/login_view');
    }


   



   

    


}