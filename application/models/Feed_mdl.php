<?php
    class Feed_mdl extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_feed($slug = FALSE) {
            if ($slug === FALSE) {
                $query = $this->db->get('feed');
                return $query->result_array();
            }

            $query = $this->db->get_where('feed', array('slug' => $slug));
            return $query->row_array();
        }
    }