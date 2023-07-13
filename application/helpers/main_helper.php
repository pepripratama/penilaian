<?php

function get_periode(){
	$ci =& get_instance();

    $query_periode = $ci->db->query("SELECT id, awal_periode, awal_periode + interval 14 day - interval 1 second as akhir_periode from tb_periode where akhir_periode is null")->row();
    

    return $query_periode;
}
function rupiah($angka){
	return number_format($angka,2,",",".");
}

function status($status){
	if ($status == 0) {
		return "Menunggu Approve Mandor";
	} elseif ($status == 1) {
		return "Menunggu Approve Departemen";
	} elseif ($status == 2) {
		return "Menunggu Pembayaran";
	} elseif ($status == 3) {
		return "Sudh Dibayar";
	}
}


?>