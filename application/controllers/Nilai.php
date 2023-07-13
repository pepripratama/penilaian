<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if ($this->session->userdata('login') == false) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['view'] = 'nilai';
		$data['title'] = 'Data Master';
		$data['nilai'] = $this->db->query("SELECT * from tb_nilai order by nilai")->result();
		$this->load->view('templates/header.php',$data);
		$this->load->view('templates/index.php',$data);
		$this->load->view('templates/footer.php');
	}


}
