<script type="text/javascript">
    function Print(){
        var printDocument = document.getElementById("report").innerHTML;
        var originalDocument = document.body.innerHTML;
        document.body.innerHTML = printDocument;
        window.print();
        document.body.innerHTML = originalDocument;
    }
</script>
<div id="report" class="card col-sm-12">
    <div class="card-header">
        <h3>Laporan Transaksi</h3>
    </div>
    <div class="card-body">
        <?php 
            $koneksi = mysqli_connect("localhost", "root", "", "sewa_mobil");
            $sql = "SELECT s.*, p.nama_pelanggan
            FROM sewa s INNER JOIN pelanggan p
            ON s.id_pelanggan = p.id_pelanggan";
            $result = mysqli_query($koneksi, $sql);
        ?>
        <table class="table">
       <thead>
         <tr>
           <th>TGL SEWA</th>
           <th>ID SEWA</th>
           <th>NAMA PELANGGAN</th>
           <th>AKSI</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($result as $hasil): ?>
           <tr>
             <td><?php echo $hasil["tgl_sewa"]; ?></td>
             <td><?php echo $hasil["id_sewa"]; ?></td>
             <td><?php echo $hasil["nama_pelanggan"]; ?></td>
             <td>
             <button onclick="Print()" type="button" class="btn btn-success">
              Print
              </button>
             </td>
           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>
     
    </div>
</div>