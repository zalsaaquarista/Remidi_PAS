<?php
  $koneksi = mysqli_connect("localhost","root","","sewa_mobil");

  if (isset($_POST["action"])) {
    // code..
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $warna = $_POST["warna"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];

    if ($action == "insert") {
      // kita tampung deskripsi file gambarnya
      $path = pathinfo($_FILES["image"]["merk"]);
      //mengabil ekstensi gambarnya
      $extensi = $path["extension"];
      // kita rangkai nama file yang akan disimpan
      $filename = $id_mobil."-".rand(1,1000).".".$extensi;
      // rand() = untuk menganbil nilai random antara 1 - 1000
      //exp: 123-809.jpg

      //simpan file gambar
      move_uploaded_file($_FILES["image"]["tmp_name"],"aset/gambar/$filename");
      $sql = "insert into mobil (id_mobil, nomor_mobil, merk, jenis, warna, tahun_pembuatan, biaya_sewa_per_hari)
              values('$id_mobil','$nomor_mobil','$merk','$jenis','$warna','$tahun_pembuatan','$biaya_sewa_per_hari','$filename')";
    } 
    else if($action == "update"){
      // ambil data dari database
      $sql = "select * from mobil where id_mobil='$id_mobil'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);
      if (isset($_FILES["image"])) {
        if (file_exists("aset/gambar/".$hasil["image"])) {
          // jika filenya tersedia
          unlink("aset/gambar/".$hasil["image"]);
          //gunanya untuk menghapus file
        }
        $path = pathinfo($_FILES["image"]["merk"]);
        //mengabil ekstensi gambarnya
        $extensi = $path["extension"];
        // kita rangkai nama file yang akan disimpan
        $filename = $id_mobil."-".rand(1,1000).".".$extensi;
        // rand() = untuk menganbil nilai random antara 1 - 1000
        //exp: 123-809.jpg

        //simpan file gambar
        move_uploaded_file($_FILES["image"]["tmp_name"],"aset/gambar/$filename");
        $sql = "update mobil set nomor_mobil='$nomor_mobil', merk='$merk', jenis='$jenis', warna='$warna', tahun_pembuatan='$tahun_pembuatan', biaya_sewa_per_hari='$biaya_sewa_per_hari', image='$filename' where id_mobil='$id_mobil'";
      } else {
        $sql = "update mobil set nomor_mobil='$nomor_mobil', merk='$merk', jenis='$jenis', warna='$warna', tahun_pembuatan='$tahun_pembuatan', biaya_sewa_per_hari='$biaya_sewa_per_hari' where id_mobil='$id_mobil'";
      }
    }
    mysqli_query($koneksi,$sql);
    header("location:template.php?page=barang");
  }
  if (isset($_GET["hapus"])) {
    // code...
    $id_mobil = $_GET["id_mobil"];
    // ambil data dari database
    $sql = " select * from buku where id_mobil='$id_mobil'";
    //eksekusi query
    $result = mysqli_query($koneksi,$sql);
    //konversi ke array
    $hasil = mysqli_fetch_array($result);
    if (file_exists("aset/gambar/".$hasil["image"])) {
      unlink("aset/gambar/".$hasil["image"]);
      //menghapus file
    }
    $sql = "delete from mobil where id_mobil='$id_mobil'";
    mysqli_query($koneksi,$sql);
    header("location:template.php?page=barang");
  }
?>
