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
   
   
   
    public function save(){
        $user_id = $this->session->userdata('po_user');
        $event_date = $this->input->post('event_date');
        $description = $this->input->post('description');

        if(!$event_date || !$description){
            echo json_encode(['status'=>'error','message'=>'All fields are required']);
            return;
        }

        $data = ['user_id'=>$user_id, 'event_date'=>$event_date, 'description'=>$description];

        if($this->db->insert('tbl_upcoming_events', $data)){
            $insert_id = $this->db->insert_id();
            $this->db->select('e.*, u.full_name, u.user_type');
            $this->db->from('tbl_upcoming_events e');
            $this->db->join('tbl_users u','u.id=e.user_id','left');
            $this->db->where('e.id',$insert_id);
            $event = $this->db->get()->row();
            echo json_encode(['status'=>'success','event'=>$event]);
        } else {
            echo json_encode(['status'=>'error','message'=>'Failed to save event']);
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
    // Save/Add or Edit SSG member
public function save_ssg_member() 
{
    $id = $this->input->post('id');
    $student_id = $this->input->post('student_id');
    $student_name = $this->input->post('student_name');

    $data = [
        'student_id'   => $student_id,
        'student_name' => $student_name,
        'profession'   => $this->input->post('profession'),
        'status'       => 'active'
    ];

    if($id){ // edit
        $this->db->where('id', $id)->update('tbl_ssg_members', $data);
        $data['id'] = $id;
        $data['is_edit'] = true;
    } else { // add
        $this->db->insert('tbl_ssg_members', $data);
        $data['id'] = $this->db->insert_id();
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
    $member = $this->db->get_where('tbl_ssg_members', ['id' => $id])->row();
    echo json_encode([
        'status' => 'success',
        'data'   => $member
    ]);
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
    $members = $this->db->get_where('tbl_ssg_members', ['status' => 'active'])->result();
    echo json_encode($members);
}

// Search students for autocomplete
public function search_students()
{
    $term = $this->input->get('term');
    $limit = $this->input->get('limit') ?? 10;

    $this->db->like('full_name', $term);
    $this->db->limit($limit);
    $students = $this->db->get('tbl_students')->result();

    echo json_encode($students);
}



}
