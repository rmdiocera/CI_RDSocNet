<?php
class Feed_mdl extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_feed($slug = FALSE)
    {
        if ($slug === FALSE) {
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('feed');
            return $query->result_array();
        }

        $query = $this->db->get_where('feed', array('slug' => $slug));
        return $query->row_array();
    }

    public function add_post()
    {
        function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
        {
            $pieces = [];
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $pieces[] = $keyspace[random_int(0, $max)];
            }
            return implode('', $pieces);
        }

        $slug = random_str(20);
        $data = array(
            'title' => 'Test',
            'slug' => $slug,
            'body' => $this->input->post('post-text')
        );

        return $this->db->insert('feed', $data);
    }

    public function showfeed() {
        $this->db->order_by('id', 'desc');
		$query = $this->db->get('feed');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
    }

    public function edit() {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $query = $this->db->get('feed');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function update() {
        $id = $this->input->post('post-id');
		$field = array(
            'body' => $this->input->post('edit-body')
		);
		$this->db->where('id', $id);
		$this->db->update('feed', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
    }

    public function delete_post($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('feed');
        return true;
    }
    
}
