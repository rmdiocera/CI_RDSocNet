<?php
    class Pages extends CI_Controller {
        public function home() {
            if (!file_exists(APPPATH.'views/pages/home.php')) {
                show_404();
            }

            $data['title'] = 'Home Page';

            $this->load->view('templates/header');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer');

            if ($this->session->userdata('logged_in')) {
                redirect('feed');
            }
        }

        public function about() {
            $data['title'] = 'About';

            $this->load->view('templates/header');
            $this->load->view('pages/about', $data);
            $this->load->view('templates/footer');

        } 
    }