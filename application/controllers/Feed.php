<?php
class Feed extends CI_Controller
{
    public function index($page = 'index')
    {
        if (!file_exists(APPPATH . 'views/feed/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page);
        $data['feed'] = $this->Feed_mdl->get_feed();

        $this->form_validation->set_rules('post-text', '', 'required', array('required' => 'Your post is empty.'));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('feed/' . $page, $data);
            $this->load->view('templates/footer');
        } else {
            $this->Feed_mdl->add_post();
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
    }    
    
    public function update(){
		$result = $this->Feed_mdl->update();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
        echo json_encode($msg);
	}

    public function delete($id) {
        $this->Feed_mdl->delete_post($id);
        redirect();
    }

}
