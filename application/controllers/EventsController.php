<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_DB_query_builder $db */
class EventsController extends CI_Controller {

	
		public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('StudentModel');
        $this->load->helper(['url', 'form']);
         $this->load->library('session');
    }
   
   
   
    public function save() {
        $user_id = $this->session->userdata('po_user');
        $event_date = $this->input->post('event_date');
        $description = $this->input->post('description');

        if (!$event_date || !$description) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }

        $data = [
            'user_id'     => $user_id,
            'event_date'  => $event_date,
            'description' => $description
        ];

        if ($this->db->insert('tbl_upcoming_events', $data)) {
            $this->db->select('e.*, u.full_name, u.user_type');
            $this->db->from('tbl_upcoming_events e');
            $this->db->join('tbl_users u', 'u.id = e.user_id', 'left');
            $this->db->where('e.user_id', $user_id);
            $this->db->where('e.event_date', $event_date);
            $this->db->where('e.description', $description);
            $this->db->order_by('e.created_at', 'DESC'); 
            $this->db->limit(1);
            $event = $this->db->get()->row();

            echo json_encode(['status' => 'success', 'event' => $event]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save event']);
        }
    }


    public function update(){
        $event_id = $this->input->post('id');
        $event_date = $this->input->post('event_date');
        $description = $this->input->post('description');

        if(!$event_id || !$event_date || !$description){
            echo json_encode(['status'=>'error','message'=>'All fields are required']);
            return;
        }

        $data = ['event_date'=>$event_date, 'description'=>$description];
        $this->db->where('id',$event_id);
        if($this->db->update('tbl_upcoming_events',$data)){
            $this->db->select('e.*, u.full_name, u.user_type');
            $this->db->from('tbl_upcoming_events e');
            $this->db->join('tbl_users u','u.id=e.user_id','left');
            $this->db->where('e.id',$event_id);
            $event = $this->db->get()->row();
            echo json_encode(['status'=>'success','event'=>$event]);
        } else {
            echo json_encode(['status'=>'error','message'=>'Failed to update event']);
        }
    }

    public function delete(){
        $event_id = $this->input->post('id');
        if(!$event_id){
            echo json_encode(['status'=>'error','message'=>'Event ID required']);
            return;
        }
        $this->db->where('id',$event_id);
        if($this->db->delete('tbl_upcoming_events')){
            echo json_encode(['status'=>'success']);
        } else {
            echo json_encode(['status'=>'error','message'=>'Failed to delete event']);
        }
    }

    public function get_events(){
        $user_id = $this->session->userdata('po_user');
        $this->db->select('e.*, u.full_name, u.user_type');
        $this->db->from('tbl_upcoming_events e');
        $this->db->join('tbl_users u','u.id=e.user_id','left');
        $this->db->where('e.user_id',$user_id);
        $this->db->order_by('e.event_date','ASC');
        $events = $this->db->get()->result();
        echo json_encode($events);
    }




    // Save (Add or Edit)
    public function search_students()
    {
        $term = $this->input->get('term');
        $limit = $this->input->get('limit') ?? 20;

        if(!$term) {
            echo json_encode([]);
            return;
        }

        // Only active students
        $this->db->select('id, fullname');
        $this->db->from('tbl_students');
        $this->db->like('fullname', $term);
        $this->db->where('status', 'active');
        $this->db->limit($limit);
        $query = $this->db->get();

        $students = $query->result_array(); 

        echo json_encode($students);
    }



    // Save/Add or Edit SSG member
   public function save_ssg_member() 
    {
        $id = $this->input->post('id');
        $student_id = $this->input->post('student_id');
        $student_name = $this->input->post('student_name');

        $this->db->where('student_name', $student_name);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $exists = $this->db->get('tbl_ssg_members')->num_rows();

        if ($exists > 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Student name already exists.'
            ]);
            return;
        }

        $data = [
            'student_id'   => $student_id,
            'student_name' => $student_name,
            'profession'   => $this->input->post('profession'),
            'status'       => 'active'
        ];

        if ($id) {
            $this->db->where('id', $id)->update('tbl_ssg_members', $data);
            $data['id'] = $id;
            $data['is_edit'] = true;
        } else {
            $this->db->insert('tbl_ssg_members', $data);

            $this->db->where('student_name', $student_name);
            $this->db->where('student_id', $student_id);
            $this->db->order_by('id', 'DESC'); 
            $this->db->limit(1);
            $inserted_row = $this->db->get('tbl_ssg_members')->row();

            $data['id'] = $inserted_row->id;
            $data['is_edit'] = false;
        }

        echo json_encode([
            'status' => 'success',
            'data'   => $data,
            'is_edit'=> $data['is_edit']
        ]);
    }


    // Get single member
    public function get_ssg_member($id)
    {
        $member = $this->db
            ->where('id', $id)
            ->get('tbl_ssg_members')
            ->row();

        echo json_encode(['status' => 'success', 'data' => $member]);
    }


    // Delete member
    public function delete_ssg_member($id)
    {
        $this->db->where('id', $id)->delete('tbl_ssg_members');
        echo json_encode(['status'=>'success']);
    }

    // Get all active members
    public function all_ssg_members()
    {
        $members = $this->db
            ->where('status', 'active')
            ->get('tbl_ssg_members')
            ->result();

        echo json_encode($members);
    }




 // =============================
    // GET CHAT USER LIST (LEFT SIDE)
    // =============================
    public function chat_users()
    {
        $me = $this->session->userdata('po_user');

        $sql = "
        SELECT u.id, u.full_name,
        (
            SELECT message FROM tbl_chat_messages 
            WHERE (sender_id = u.id AND receiver_id = $me)
               OR (sender_id = $me AND receiver_id = u.id)
            ORDER BY created_at DESC LIMIT 1
        ) AS last_message,
        (
            SELECT created_at FROM tbl_chat_messages 
            WHERE (sender_id = u.id AND receiver_id = $me)
               OR (sender_id = $me AND receiver_id = u.id)
            ORDER BY created_at DESC LIMIT 1
        ) AS last_time
        FROM tbl_users u
        WHERE u.id != $me
        HAVING last_message IS NOT NULL
        ORDER BY last_time DESC
        ";

        echo json_encode($this->db->query($sql)->result());
    }

    public function fetch_messages()
    {
        $me = $this->session->userdata('po_user');
        $other = $this->input->post('receiver_id');

        $this->db->where("
            (sender_id = $me AND receiver_id = $other)
            OR
            (sender_id = $other AND receiver_id = $me)
        ");
        $this->db->order_by('created_at', 'ASC');

        echo json_encode($this->db->get('tbl_chat_messages')->result());
    }

    public function send_message()
    {
        $this->db->insert('tbl_chat_messages', [
            'sender_id'   => $this->session->userdata('po_user'),
            'receiver_id' => $this->input->post('receiver_id'),
            'message'     => $this->input->post('message'),
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        echo json_encode(['status' => 'success']);
    }


}
