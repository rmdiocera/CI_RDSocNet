<?php
    class Users extends CI_Controller {
        public function login() {
            $data['title'] = 'Log in to your account.';

            $this->form_validation->set_rules('username', 'Username', 'required', array('required' => 'The Username field is empty.'));
            $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'The Password field is empty.'));
            
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            } else {
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));
                $user_id = $this->User_mdl->login($username, $password);
                $name = $this->User_mdl->get_name($user_id);

                if ($user_id) {
                    $userData = array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'name' => $name,
                        'logged_in' => true 
                    );

                    $this->session->set_userdata($userData);
                    redirect('feed');
                } else {
                    $this->session->set_flashdata('user_login_failed', 'User does not exist, ever.');
                    redirect('login');
                }
            }
        }

        public function logout() {
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            redirect('login');
        }

        public function register() {
            $data['title'] = 'Sign up for free.';

            $this->form_validation->set_rules('name', 'Name', 'required', array('required' => 'The Name field is empty.'));
            $this->form_validation->set_rules('email', '', 'required|callback_check_email_exists', array('required' => 'The Email field is empty.'));
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists', array('required' => 'The Username field is empty.'));
            $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'The Password field is empty.'));
            $this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('users/register', $data);
                $this->load->view('templates/footer');
            } else {
                $enc_pw = md5($this->input->post('password'));
                $this->User_mdl->register($enc_pw);
                $this->session->set_flashdata('user_registered', 'Account registered successfully. Log in to your account now');
                redirect();
            }
        }

        public function check_username_exists($username) {
            $this->form_validation->set_message('check_username_exists', 'Username already in use.');
            if ($this->User_mdl->check_username_exists($username)) {
                return true;
            } else {
                return false;
            }
        }

        public function check_email_exists($email) {
            $this->form_validation->set_message('check_email_exists', 'Email already in use.');
            if ($this->User_mdl->check_email_exists($email)) {
                return true;
            } else {
                return false;
            }
        }
    }