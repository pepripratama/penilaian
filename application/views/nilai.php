<div class="card shadow">
  <h5 class="card-header text-white bg-info">Daftar Pelanggan</h5>
    <div class="card-body">
    <table class="table" id="datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nilai</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($nilai as $n) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $n->nilai ?></td>
          <td><?= $n->harga ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
