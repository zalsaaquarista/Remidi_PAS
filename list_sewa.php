<div class="card col-sm-12">
  <div class="card-header">
    <h3>Daftar Yang diSewa</h3>
  </div>
  <div class="card-body">
    <form action="db_sewa.php?checkout=true" method="post"
    onsubmit="return confirm('Apakah anda yakin ingin menyewa ini?')">
    <table class="table">
      <thead>
        <tr>
          <th>Nomor Mobil</th>
          <th>Merk</th>
          <th>Jenis</th>
          <th>Warna</th>
          <th>Lama Sewa</th>
          <th>Biaya sewa/hari</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION["session_sewa"] as $hasil): ?>
          <tr>
            <td><?php echo $hasil["nomor_mobil"]; ?></td>
            <td><?php echo $hasil["merk"]; ?></td>
            <td><?php echo $hasil["jenis"]; ?></td>
            <td><?php echo $hasil["warna"]; ?></td>
            <td><input type="date" name="jumlah<?php echo $hasil["id_mobil"];?>" max="1" min="1" required></td>
            <td><?php echo number_format($hasil["biaya_sewa_per_hari"]); ?></td>
            <td><a href="db_sewa.php?hapus=true&id_mobil=<?php echo $hasil["id_mobil"];?>">
              <button type="button" class="btn btn-danger">Hapus</button>
            </a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-secondary btn-block">CHECKOUT</button>
    </form>
  </div>
</div>
