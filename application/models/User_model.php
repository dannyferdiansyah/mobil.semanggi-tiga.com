<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_users() {
        $query = $this->db->get('users');
        return $query;
    }

    public function create_user($username, $password) {
        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        );
        return $this->db->insert('users', $data);
    }

    public function update_user_token($user_id, $token) {
        $this->db->where('id', $user_id);
        $this->db->update('users', array('remember_token' => $token));
    }

    public function get_user_by_token($token) {
        $this->db->where('remember_token', $token);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row();
    }
}
