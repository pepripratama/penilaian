<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal"><i class="fas fa-edit"></i> Input Nilai</button>
<hr>
<div class="card shadow">
  <h5 class="card-header text-white bg-info">Data Penilaian</h5>
  <div class="card-body">
    <h5> Periode <?= date('d-m-Y', strtotime($awal_periode)) ?> - <?= date('d-m-Y', strtotime($akhir_periode)) ?></h5>
    <hr>
    <table class="table" id="datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pekerja</th>
          <th>No. Karyawan</th>
          <th class="text-right">A</th>
          <th class="text-right">B</th>
          <th class="text-right">C</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $grandtotal = 0;
        $no = 1;
        foreach ($penilaian as $n) { ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $n->nama ?></td>
            <td><?= $n->rfid ?></td>
            <td class="text-right"><?= $n->nilai_a ?></td>
            <td class="text-right"><?= $n->nilai_b ?></td>
            <td class="text-right"><?= $n->nilai_c ?></td>
            <td><?= status($n->status) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog">
  <form id="form_tambah">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="exampleModalLabel">Form Nilai</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Karyawan</label>
            <select name="karyawan_id" class="form-control">
              <option>-- Pilih Karyawan --</option>
              <?php foreach ($karyawan as $k) { ?>
                <option value="<?= $k->id ?>"><?= $k->nama ?> (<?= $k->rfid ?>)</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nilai A</label>
            <input name="nilai_a" id="nilai_a" type="number" class="form-control" min="0" max="12" value="0">
          </div>
          <div class="form-group">
            <label>Nilai B</label>
            <input name="nilai_b" id="nilai_b" type="number" class="form-control" min="0" max="12" value="0">
          </div>
          <div class="form-group">
            <label>Nilai C</label>
            <input name="nilai_c" id="nilai_c" type="number" class="form-control" min="0" max="12" value="0">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
          <input type="button" class="btn btn-primary" id="btn_simpan" value="Simpan">
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  $("#btn_simpan").click(function(e) {

    let total = $("#nilai_a").val() + $("#nilai_b").val() + $("#nilai_c").val();
    if (total >= 14) {
      alert("Total nilai melebihi batas maksimum !, total nilai tidak boleh melebihi 14");
    } else {
      let dataForm = $("#form_tambah").serialize();
      $.ajax({
        type: "POST",
        url: "<?= base_url('Input_nilai/simpan') ?>",
        data: dataForm,
        dataType: "json",
        success: function(response) {
          if(response.success)
          {
            location.href = "<?= base_url('input_nilai') ?>";
          } else {
            alert(response.message);
          }
          
        }
      });
    }


  });
</script>