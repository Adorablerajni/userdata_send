<?php if ( ! defined('BASEPATH')) exit('notes_body(server, mailbox, msg_number) direct script access allowed');
 
class User extends CI_Model {
     
    function batchInsert($data){
        //get user entries 
        $this->load->database();
            
        $count = count($data['name']); 
        for($i = 0; $i<$count; $i++){
            if (!isset($data['phone'])) {
                $data['phone'] = NULL;
            }if (!isset($data['city'])) {
                $data['city'] = NULL;
            }if (!isset($data['state'])) {
                $data['state'] = NULL;
            }if (!isset($data['country'])) {
                $data['country'] = NULL;
            }if (!isset($data['age'])) {
                $data['age'] = NULL;
            }if (!isset($data['gender'])) {
                $data['gender'] = NULL;
            }
            $entries[] = array(
                'Name'=>$data['name'][$i],
                'Email'=>$data['email'][$i],
                'Phone'=>$data['phone'][$i],
                'City'=>$data['city'][$i],
                'State'=>$data['state'][$i],
                'Country'=>$data['country'][$i],
                'Age'=>$data['age'][$i],
                'Gender'=>$data['gender'][$i],
                );
        }
        $this->db->insert_batch('users', $entries); 
        if($this->db->affected_rows() > 0)
            return true;

        else
            return false;
    }
     public function get_data($count= 1) {   
            $this->load->database();     
            $this->db->select();
            $this->db->from('users');
            $this->db->order_by("user_id", "desc"); 
            $this->db->limit($count); 
            $query = $this->db->get();
            $users = array();
            foreach ($query->result() as $row)
                    array_push($users, $row);

            return $users;
           
        } 
}
