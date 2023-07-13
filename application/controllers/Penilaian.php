<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if ($this->session->userdata('login') == false) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['view'] = 'penilaian';
		$data['title'] = 'Penilaian';
		$periode_id = get_periode()->id;
		$data['penilaian'] = $this->db->query("SELECT tb_karyawan.rfid, tb_karyawan.nama, tb_nilai.nilai, tb_nilai.harga, tb_penilaian.jumlah, (SELECT jumlah from tb_penilaian where id_nilai =1 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_a, (SELECT jumlah from tb_penilaian where id_nilai =2 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_b, (SELECT jumlah from tb_penilaian where id_nilai =3 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_c from tb_penilaian join tb_karyawan on tb_karyawan.id = tb_penilaian.karyawan_id join tb_nilai on tb_nilai.id = tb_penilaian.id_nilai where tarik_hrd = 1 and tb_penilaian.periode_id = $periode_id group by tb_karyawan.id")->result();
		$data['harga_a'] = $this->db->query("SELECT harga from tb_nilai where id = 1")->row()->harga;
		$data['harga_b'] = $this->db->query("SELECT harga from tb_nilai where id = 2")->row()->harga;
		$data['harga_c'] = $this->db->query("SELECT harga from tb_nilai where id = 3")->row()->harga;
		$this->load->view('templates/header.php',$data);
		$this->load->view('templates/index.php',$data);
		$this->load->view('templates/footer.php');
	}

	public function tarik_data(){
		$periode_id = get_periode()->id;
		$query = $this->db->query("UPDATE tb_penilaian set tarik_hrd=1, status = 2 where periode_id = $periode_id and tarik_hrd = 0");
		redirect(base_url('Penilaian'));
	}

	public function kirim_data(){
        $periode_id = get_periode()->id;
        $query = $this->db->query("UPDATE tb_penilaian, status = 3 where periode_id = $periode_id and status = 2");
		$query_periode = $this->db->query("select id, awal_periode as awal_periode, awal_periode + interval 14 day - interval 1 second as akhir_periode, awal_periode + interval 14 day as akhir_periode2 from tb_periode where akhir_periode is null")->row();
        $awal_periode_fix   = $query_periode->awal_periode;
        $akhir_periode_fix  = $query_periode->akhir_periode;
        $akhir_periode2_fix  = $query_periode->akhir_periode2;

        $ubah_periode_akhir = $this->db->query("UPDATE tb_periode SET akhir_periode = '$akhir_periode_fix', updated_date=now() WHERE akhir_periode IS NULL ");

        $input_periode_selanjutnya = $this->db->query("INSERT INTO tb_periode (awal_periode) VALUES ('$akhir_periode2_fix') ");
        redirect(base_url('Penilaian'));
	}


}
