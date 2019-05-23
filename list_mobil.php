<?php
$koneksi = mysqli_connect("localhost","root","","sewa_mobil");
$sql = "select * from mobil";
$result = mysqli_query($koneksi,$sql);
?>

<div class="row">
    <?php foreach ($result as $hasil): ?>
    <div class="card col-sm-4">
        <div class="card-body">
            <img src="image_mobil/<?php echo $hasil["image"];?>" width="100%" class="img">
        </div>
        <div class="card-footer">
            <h5 class="text-center"><?php echo $hasil["merk"]; ?></h5>
            <h6 class="text-center"><?php echo $hasil["jenis"]; ?></h6>
            <h6 class="text-center"><?php echo $hasil["warna"]; ?></h6>
            <h6 class="text-center"><?php echo $hasil["tahun_pembuatan"]; ?></h6>

            <a href="db_sewa.php?sewa=true&id_mobil=<?php echo $hasil["id_mobil"];?>">
            <button type="button" class="btn btn-block btn-sm btn-secondary">SEWA</button>
            </a>

        </div>
    </div>
    <?php endforeach; ?>
</div>
