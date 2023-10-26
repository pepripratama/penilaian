<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if ($this->session->userdata('login') == false) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['view'] = 'templates/home';
		$data['title'] = 'Dashboard';
		$periode_id = get_periode()->id;
		$data['approve_mandor'] = $this->db->query("SELECT * from tb_penilaian where periode_id = '$periode_id' and status = 0 group by karyawan_id order by id")->num_rows();
		$data['approve_departemen'] = $this->db->query("SELECT * from tb_penilaian where periode_id = '$periode_id' and status = 1 group by karyawan_id order by id")->num_rows();
		$data['approve_pembayaran'] = $this->db->query("SELECT * from tb_penilaian where periode_id = '$periode_id' and status = 2 group by karyawan_id order by id")->num_rows();
		$data['total_karyawan'] = $this->db->query("SELECT * from tb_karyawan where deleted_date is null")->num_rows();
		$this->load->view('templates/header.php',$data);
		$this->load->view('templates/index.php',$data);
		$this->load->view('templates/footer.php');
	}


}
