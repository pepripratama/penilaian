<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_nilai extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if ($this->session->userdata('login') == false) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['view'] = 'input_nilai';
		$data['title'] = 'Input Penilaian';
		$periode_id = get_periode()->id;
		$data['awal_periode'] = get_periode()->awal_periode;
		$data['akhir_periode'] = get_periode()->akhir_periode;
		$data['penilaian'] = $this->db->query("SELECT tb_karyawan.nama, tb_karyawan.rfid, tb_nilai.nilai, tb_nilai.harga, tb_penilaian.jumlah, tb_penilaian.tarik_hrd, tb_penilaian.status, (SELECT jumlah from tb_penilaian where id_nilai =1 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_a, (SELECT jumlah from tb_penilaian where id_nilai =2 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_b, (SELECT jumlah from tb_penilaian where id_nilai =3 and periode_id = $periode_id and karyawan_id = tb_karyawan.id) as nilai_c from tb_penilaian join tb_karyawan on tb_karyawan.id = tb_penilaian.karyawan_id join tb_nilai on tb_nilai.id = tb_penilaian.id_nilai where tb_penilaian.periode_id = $periode_id group by tb_karyawan.id")->result();
		$data['karyawan'] = $this->db->query("SELECT * from tb_karyawan where nama not like '-' order by nama")->result();
		$this->load->view('templates/header.php',$data);
		$this->load->view('templates/index.php',$data);
		$this->load->view('templates/footer.php');
	}

	public function simpan()
	{
		$karyawan_id = $this->input->post('karyawan_id');
		$nilai_a = $this->input->post('nilai_a');
		$nilai_b = $this->input->post('nilai_b');
		$nilai_c = $this->input->post('nilai_c');
		$periode_id = get_periode()->id;

		// cek nilai apakah sudah ada atau belum
		$cek_nilai = $this->db->query("SELECT * from tb_penilaian where karyawan_id = '$karyawan_id' and periode_id = '$periode_id'")->row();

		if ($cek_nilai){
			$data["message"] = "Data nilai untuk karyawan ini sudah pernah diinput dalam periode ini !";
			$data["success"] = false;
		} else {
			$this->db->trans_start();
		// insert nilai a
		$data_a = array(
			'karyawan_id' => $karyawan_id,
			'id_nilai' => 1,
			'jumlah' => $nilai_a,
			'periode_id' => $periode_id,
		);
		$this->db->insert('tb_penilaian',$data_a);

		// insert nilai b
		$data_b = array(
			'karyawan_id' => $karyawan_id,
			'id_nilai' => 2,
			'jumlah' => $nilai_b,
			'periode_id' => $periode_id,
		);
		$this->db->insert('tb_penilaian',$data_b);

		// insert nilai c
		$data_c = array(
			'karyawan_id' => $karyawan_id,
			'id_nilai' => 3,
			'jumlah' => $nilai_c,
			'periode_id' => $periode_id,
		);
		$this->db->insert('tb_penilaian',$data_c);
		$this->db->trans_complete();

		$this->session->set_flashdata("success","Data berhasil ditambahkan !");

		$data["message"] = "Data berhasil ditambahkan !";
		$data["success"] = true;
		}
		
		echo json_encode($data);
	}


}
