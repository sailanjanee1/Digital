<?php 
class School_model extends CI_Model{ 

     
    public function get_all()
    {
        $schools = $this->db->get("schools")->result();
        return $schools;
    }
    public function store()
    {    
        $data = [
            'name'     => $this->input->post('name'),
            'location' => $this->input->post('location'),
            'created_at' => date('Y-m-d H:i:s')
        ];
 
        $result = $this->db->insert('schools', $data);
        return $result;
    }
    public function get($id)
    {
        $project = $this->db->get_where('schools', ['id' => $id ])->row();
        return $project;
    }
    public function update($id) 
    {
        $data = [
            'name'     => $this->input->post('name'),
            'location' => $this->input->post('location'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
 
        $result = $this->db->where('id',$id)->update('schools',$data);
        return $result;
                 
    }
    public function delete($id)
    {
        $data = [
            'is_active'     => 0
        ];
 
        $result = $this->db->where('id',$id)->update('schools',$data);
        return $result;
    }
     
}
?>