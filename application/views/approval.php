
<div class="card shadow">
  <h5 class="card-header text-white bg-info">Data Penilaian</h5>
    <div class="card-body">
      <?php
      $role_id = $this->session->userdata('role_id');
      if ($role_id == 2) { ?>
        <a class="btn btn-success <?= (count($penilaian) > 0) ? '' : 'disabled' ?>" href="<?= base_url('Approval/approve_mandor') ?>"><i class="fas fa-check"></i> Approve All</a>
      <?php } elseif ($role_id == 3) { ?>
        <a class="btn btn-success <?= (count($penilaian) > 0) ? '' : 'disabled' ?>" href="<?= base_url('Approval/approve_dep') ?>"><i class="fas fa-check"></i> Approve All</a>
      <?php } ?>
      <hr>
    <table class="table" id="datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pekerja</th>
          <th>No Karyawan</th>
          <th class="text-right">A</th>
          <th class="text-right">B</th>
          <th class="text-right">C</th>
          <th class="text-right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $grandtotal = 0;
        $no = 1; foreach ($penilaian as $n) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $n->nama ?></td>
          <td><?= $n->rfid ?></td>
          <td class="text-right"><?= $n->nilai_a ?></td>
          <td class="text-right"><?= $n->nilai_b ?></td>
          <td class="text-right"><?= $n->nilai_c ?></td>
          <td>
            <?php
            if ($role_id == 2) { ?>
              <a class="btn btn-success" href="<?= base_url('Approval/approve_mandor/').$n->karyawan_id ?>"><i class="fas fa-check"></i> Approve</a>
            <?php } elseif ($role_id == 3) { ?>
              <a class="btn btn-success" href="<?= base_url('Approval/approve_dep/').$n->karyawan_id ?>"><i class="fas fa-check"></i> Approve</a>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
