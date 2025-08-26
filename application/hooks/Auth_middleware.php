<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_middleware {
    public function check_login() {
        $CI =& get_instance();
        $user_id = $CI->session->userdata('user_id');

        if (!$user_id) {
            $token = get_cookie('remember_me');
            if ($token) {
                $user = $CI->user_model->get_user_by_token($token);
                if ($user) {
                    $CI->session->set_userdata('user_id', $user->id);
                } else {
                    redirect('auth/login');
                }
            } else {
                redirect('auth/login');
            }
        }
    }
}
