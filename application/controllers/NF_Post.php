<?php
    class NF_Post extends CI_Controller {

        public function post($slug = NULL) {
            $data['post'] = $this->Feed_mdl->get_feed($slug);
            
            if (empty($data['post'])) {
                show_404();
            }

            $data['title'] = $data['post']['title'];

            $this->load->view('templates/header');
            $this->load->view('post/post', $data);
            $this->load->view('templates/footer');
        }

        public function delete($id) {
            $this->Feed_mdl->delete_post($id);
            redirect();
        }
    }

?>