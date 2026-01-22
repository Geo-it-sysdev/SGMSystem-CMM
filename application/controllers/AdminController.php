<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('AuthModel');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');

    }
    

   

    
   


     //=============== User profile function ( view profile, update username & password )=====================\\
     public function profile()
     {
         $user_id = $this->session->userdata("po_user");
     
         if (!$user_id) {
             redirect('AuthController/login_view');
             return;
         }
     
         // Load user profile
         $data['profile'] = $this->AdminModel->get_user($user_id);
     
        $this->load->view('template/header', $data);
         $this->load->view('template/sidebar');
         $this->load->view('template/profile', $data);
         $this->load->view('template/footer');
     }
     
     
     public function upload_profile_photo()
     {
         $user_id = $this->input->post('user_id');
     
         // Fetch old image
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
     
         // New image
         $upload_data = $this->upload->data();
         $new_filename = 'assets/images/users/' . $upload_data['file_name'];
     
         // Delete old image (except default)
         if (!empty($old_photo) && file_exists('./' . $old_photo) && $old_photo != 'assets/img/user-dummy-img.jpg') {
             unlink('./' . $old_photo);
         }
     
         // Update DB
         $this->db->where('id', $user_id)->update('tbl_users', [
             'photo' => $new_filename
         ]);
     
         echo json_encode([
             'status' => 'success',
             'new_photo' => base_url($new_filename)
         ]);
     }
     
     
    public function update_profile() {
        if (!$this->input->is_ajax_request()) {
            show_error('No direct script access allowed');
        }
    
        $user_id = $this->session->userdata('po_user');
        $user_name = trim($this->input->post('user_name'));
        $password = $this->input->post('newpassword');
    
        $current_user = $this->AdminModel->get_user($user_id);
        if (!$current_user) {
            echo json_encode(['status' => 'error', 'message' => 'User not found.']);
            return;
        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        $update_data = [];
    
        if (!empty($user_name)) {
            $update_data['user_name'] = $user_name;
        }
    
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_data['password'] = $hashed_password;
        }
    
        if (empty($update_data)) {
            echo json_encode(['status' => 'error', 'message' => 'Please enter a new username or password to update.']);
            return;
        }
    
        $updated = $this->AdminModel->update_per_user($user_id, $update_data);
    
        if ($updated) {
            if (!empty($user_name)) {
                $this->session->set_userdata('user_name', $user_name);
            }
            echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update profile.']);
        }
    }

   //=============== Chat us function (chat & retrive chat) =====================\\
    public function chat_us() {
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }

        $data['users'] = $this->AdminModel->get_all_users_with_unread_count($user_id);

        $data['profile'] = $this->AdminModel->get_user($user_id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/chat_us', $data);
        $this->load->view('template/footer');
    }


    public function fetch_messages($receiver_id) {
        $sender_id = $this->session->userdata("po_user");
        $messages = $this->AdminModel->get_chat_messages($sender_id, $receiver_id);
        echo json_encode($messages);
    }

    public function send_message() {
        $sender_id = $this->session->userdata("po_user");
        if (!$sender_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        $receiver_id = $this->input->post("receiver_id");
        $message = $this->input->post("message");

        if (!empty($message) && !empty($receiver_id)) {
            $inserted = $this->AdminModel->insert_chat_message([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'message' => $message,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
            if ($inserted) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to insert message']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        }
    }
    
    
    public function datatable() {
        $user_id = $this->session->userdata("po_user");
        if (!isset($user_id)) {
            redirect('AuthController/login_view');
            return;
        }

  

        $data['profile'] = $this->AdminModel->get_user($user_id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/datatable');
        $this->load->view('template/footer');
    }

    
    public function update_user_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
    
        if ($id && $status) {
            $this->db->where('id', $id);
            $this->db->update('pharma_users', ['status' => $status]);
    
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    
    

   
    public function fetch_users() {
        $users = $this->AdminModel->get_all_users();
        echo json_encode($users);
    }

    public function add_user() {
        $user_name = $this->input->post('username');
    
        if ($this->AdminModel->is_user_name_exists($user_name)) {
            echo json_encode(['status' => 'duplicate', 'message' => 'Username already exists.']);
            return;
        }
    
        $grades = $this->input->post('grade');
        $subjects = $this->input->post('subjects');
    
        // Logged-in user ID
    
        $data = [
            'full_name' => $this->input->post('full_name'),
            'user_name' => $user_name,
            'user_type' => $this->input->post('user_type'),
            'grades'    => is_array($grades) ? implode(', ', $grades) : '',
            'subjects'  => is_array($subjects) ? implode(', ', $subjects) : '',
            'password'  => password_hash('12345', PASSWORD_DEFAULT),
            'status'    => 'Active',
            'date_created' => date('Y-m-d H:i:s')
        ];
    
        $insert = $this->AdminModel->insert_user($data);
        echo json_encode([
            'status' => $insert ? 'success' : 'error',
            'message' => $insert ? 'User added successfully!' : 'Error saving user.'
        ]);
    }
    
    
    public function get_user_by_id($id) {
        echo json_encode($this->AdminModel->get_user($id));
    }
    
    public function update_user() {
        $id = $this->input->post('id');
    
        $grades = $this->input->post('grade');
        $subjects = $this->input->post('subjects');
    
        $data = [
            'full_name' => $this->input->post('full_name'),
            'user_name' => $this->input->post('username'),
            'user_type' => $this->input->post('user_type'),
            'grades'    => is_array($grades) ? implode(', ', $grades) : '',
            'subjects'  => is_array($subjects) ? implode(', ', $subjects) : ''
        ];
    
        $update = $this->AdminModel->update_user($id, $data);
    
        echo json_encode([
            'status' => $update ? 'success' : 'error',
            'message' => $update ? 'User updated successfully!' : 'Error updating user.'
        ]);
    }
    

    public function delete_user($id) {
        $delete = $this->AdminModel->delete_user($id);
        echo json_encode(['status' => $delete ? 'success' : 'error']);
    }

  
    

    
    

    


}