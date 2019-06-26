<?php
    class Feed extends CI_Controller {
        public function index($page = 'index') { 
            if (!file_exists(APPPATH.'views/feed/'.$page.'.php')) {
                show_404();
            }

            $data['title'] = ucfirst($page);
            $data['feed'] = $this->Feed_mdl->get_feed();

            $this->load->view('templates/header');
            $this->load->view('feed/'.$page, $data);
            $this->load->view('templates/footer');
        }
    }

?>