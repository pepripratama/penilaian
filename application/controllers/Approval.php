<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if ($this->session->userdata('login') == false) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['view'] = 'approval';
		$data['title'] = 'Approval';
		$id_role = $this->session->userdata('role_id');
		if ($id_role == 2) {
			$status = 0;
		} elseif ($id_role == 3) {
			$status = 1;
		} else {
			$status = "-";
		}
		$periode_id = get_periode()->id;
		$data['penilaian'] = $this->db->query("SELECT tb_penilaian.karyawan_id, tb_penilaian.id, tb_karyawan.nama, tb_karyawan.rfid, tb_nilai.nilai, tb_nilai.harga, tb_penilaian.jumlah, (SELECT jumlah from tb_penilaian where id_nilai =1 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_a, (SELECT jumlah from tb_penilaian where id_nilai =2 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_b, (SELECT jumlah from tb_penilaian where id_nilai =3 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_c from tb_penilaian join tb_karyawan on tb_karyawan.id = tb_penilaian.karyawan_id join tb_nilai on tb_nilai.id = tb_penilaian.id_nilai where tb_penilaian.status = '$status' and tb_penilaian.periode_id = $periode_id group by tb_karyawan.id")->result();
		$this->load->view('templates/header.php',$data);
		$this->load->view('templates/index.php',$data);
		$this->load->view('templates/footer.php');
	}

	public function approve_mandor($id){
		$periode_id = get_periode()->id;
		if ($id == "all") {
			$query = $this->db->query("UPDATE tb_penilaian set status = 1 where status = 0 and periode_id = '$periode_id' ");
		} else {
			$query = $this->db->query("UPDATE tb_penilaian set status = 1 where status = 0 and karyawan_id = '$id' and periode_id = '$periode_id'");
		}
		redirect(base_url('Approval'));

		
	}

	public function approve_dep($id){
		$periode_id = get_periode()->id;
		if ($id == "all") {
			$query = $this->db->query("UPDATE tb_penilaian set status = 2 where status = 1 and periode_id = '$periode_id' ");
		} else {
			$query = $this->db->query("UPDATE tb_penilaian set status = 2 where status = 1 and karyawan_id = '$id' and periode_id = '$periode_id'");
		}
		redirect(base_url('Approval'));

		
	}


}
