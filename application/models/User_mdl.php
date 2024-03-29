<?php
    class User_mdl extends CI_Model {
        public function register($enc_pw) {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $enc_pw
            );
            return $this->db->insert('users', $data);
        }

        public function login($username, $password) {
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            
            $result = $this->db->get('users');
            
            if ($result->num_rows() === 1) {
                return $result->row(0)->id;
            } else {
                return false;
            }
        }

        public function get_name($id) {
            $this->db->where('id', $id);
            $query = $this->db->get('users');

            if ($query->num_rows() > 0) {
                return $query->row(0)->name;
            }

        }

        // For checking same username/email
        public function check_username_exists($username) {
            $query = $this->db->get_where('users', array('username' => $username));
            if (empty($query->row_array())) {
                return true;
            } else {
                return false;
            } 
        }

        public function check_email_exists($email) {
            $query = $this->db->get_where('users', array('email' => $email));
            if (empty($query->row_array())) {
                return true;
            } else {
                return false;
            } 
        }
    }