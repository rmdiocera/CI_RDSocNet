<?php
require_once('vendor/autoload.php');
class Feed extends CI_Controller
{
    public function index($offset = 0)
    {
        $config['base_url'] = base_url().'feed/';
        $config['total_rows'] = $this->db->count_all('feed');
        $config['per_page'] = 5;
        $config['uri_segment'] = 2;
        $config['attributes'] = array('class' => 'page-nav-link');
        
        $this->pagination->initialize($config);

        if (!file_exists(APPPATH . 'views/feed/index.php')) {
            show_404();
        }

        $data['title'] = "Latest Posts";
        $data['feed'] = $this->Feed_mdl->get_feed(FALSE, $config['per_page'], $offset);

        $this->form_validation->set_rules('post-text', '', 'required', array('required' => 'Your post is empty.'));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('feed/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Upload image
            $config['upload_path'] = '././assets/images/posts';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '1080';
            $config['max_height'] = '1920 ';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.jpg';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $this->Feed_mdl->add_post($post_image);
            $this->session->set_flashdata('post_success', 'Post submitted.');
            redirect('feed');
        }

        if (!$this->session->userdata('logged_in')) {
            redirect();
        }
    }

    public function showFeed() {
        $result = $this->Feed_mdl->showfeed();
        echo json_encode($result);
    }

    public function edit(){
        $result = $this->Feed_mdl->edit();
        echo json_encode($result);

        if (!$this->session->userdata('logged_in')) {
            redirect();
        }
    }    
    
    public function update(){
        $result = $this->Feed_mdl->update();
        $this->session->set_flashdata('post_updated', 'Post updated.');
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
            $msg['success'] = true;
		}
        echo json_encode($msg);

        if (!$this->session->userdata('logged_in')) {
            redirect();
        }
	}

    public function delete($id) {
        $this->Feed_mdl->delete_post($id);
        $this->session->set_flashdata('post_deleted', 'Post deleted.');
        redirect('feed');

        if (!$this->session->userdata('logged_in')) {
            redirect();
        }
    }

}
