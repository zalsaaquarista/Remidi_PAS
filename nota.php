<script type="text/javascript">
    function Print(){
        var printDocumnet = document.getElementById("report").innerHTML;
        var originalDocument = document.body.innerHTML;
        document.body.innerHTML = printDocument;
        document.getElementById("print").style.display="none";
        window.print();
        document.body.innerHTML = originalDocument;
    }
</script>
<div id="report" class="cord col-sm-12">
    <div class="card-header">
    <h3>Nota Transaksi</h3>
    </div>
    <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","sewa_mobil");
    $id_sewa = $_GET["id_sewa"];
    // data transaksi
    $sql = "SELECT s.id_sewa, p.nama_pelanggan, s.tgl_sewa
    FROM sewa s INNER JOIN pelanggan p 
    ON s.id_pelanggan = p.id_pelanggan
    WHERE s.id_sewa = '$id_sewa'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);

    // data Barang
    $sql2 = "SELECT m.*, dt.lama_sewa, dt.harga_sewa
    FROM mobil m INNER JOIN detail_sewa dt
    on m.id_mobil = dt.id_mobil
    where dt.id_sewa='$id_sewa'";
    $result2 = mysqli_query($koneksi,$sql2);
    ?>

    <h4>ID. Sewa: <?php echo $hasil["id_sewa"]; ?></h4>
    <h4>Nama Penyewa: <?php echo $hasil["nama_pelanggan"]; ?></h4>
    <h4>Tgl. Sewa: <?php echo $hasil["tgl_sewa"]; ?></h4>

    <table class="table">
    <thead>
        <tr>
          <th>ID Mobil</th>
          <th>Nomor Mobil</th>
          <th>Lama Sewa</th>
          <th>Harga Sewa</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; foreach ($result2 as $mobil): ?>
          <tr>
            <td><?php echo $mobil["id_mobil"]; ?></td>
            <td><?php echo $mobil["nomor_mobil"]; ?></td>
            <td><?php echo $mobil["lama_sewa"]; ?></td>
            <td><?php echo "Rp ".number_format($mobil["biaya_sewa_per_hari"]); ?></td>
            <td><?php echo "Rp ".number_format($mobil["biaya_sewa_per_hari"]*$mobil["lama_sewa"]); ?></td>
          </tr>
          <?php
          $total += $mobil["biaya_sewa_per_hari"]*$mobil["lama_sewa"];
          endforeach;
           ?>
      </tbody>
    </table>
    <h2 class="text-right text-success">
          <?php echo "Rp ".number_format($total); ?>
    </h2>
    </div>
</div>