<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	
	public function index()
	{
        $data['title'] = 'Login Page';
        $this->load->view('templates/header.php', $data);
        $this->load->view('auth/login.php');
        $this->load->view('templates/footer.php');

    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
		$where = array(
			'username' => $username,
            'password' => md5($password)
		);
		$user = $this->db->get_where('tb_user', $where);

        // jika usernya ada
        if ($user->num_rows() > 0) {
            $user = $user->row();
            $data = [
                'id' => $user->id,
                'name' => $user->username,
                'role_id' => $user->role_id,
                'login' => true,
            ];
            $this->session->set_userdata($data);
            redirect(base_url('Dashboard'));
        } else {
            $this->session->set_flashdata('gagal', "User Tidak Ditemukan, Silahkan Hubungi Tim IT !");
            redirect(base_url('auth'));
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert"> You have been logout!</div>');
        redirect('auth');
    }
}
