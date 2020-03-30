<?php
include '../aset/header.php';
include '../koneksi.php';

$id_pinjam =$_GET['id_pinjam'];
$sql="SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku WHERE id_pinjam=$id_pinjam";
$res=mysqli_query($koneksi,$sql);
$detail=mysqli_fetch_assoc($res);
 ?>
 <div class="container">
   <div class="row-mt-4">
     <div class="col-md-7">
       <h2>Detail Peminjaman</h2>
       <hr class="bg-light">
       <table class="table table-bordered">
         <tr>
           <td> <strong>Judul</strong> </td>
           <td> <?=$detail['judul']?> </td>
         </tr>
         <tr>
           <td> <strong>Tanggal Pinjam</strong> </td>
           <td><?=date('d F Y',strtotime($detail['tgl_pinjam']))?></td>
         </tr>
         <tr>
           <td> <strong>Tanggal Jatuh Tempo</strong> </td>
           <td><?=date('d F Y',strtotime($detail['tgl_jatuhTemp']))?></td>
         </tr>
         <tr>
           <td> <strong>Tanggal Kembali</strong> </td>
           <td>
             <?php
             if ($detail['tgl_pinjam'] == NULL) {
               echo "-";
             } else {
               echo date('d F Y',strtotime($detail['$tgl_kembali']));
             }
              ?>
              <tr>
                <td> <strong>Status</strong> </td>
                <td><?=$detail['status'] ?> </td>
              </tr>
              <?php
              if ($detail['denda']>0) {
              }
               ?>
               <tr>
                 <td class="table-danger" colspan="2">
                   <strong> Denda yang harus dibayar:</strong>Rp <?=$detail['denda']?>
                 </td>
               </tr>
               <?php
             }
                ?>
                <tr>
                  <td class="text-right" colspan="2">
                    <a href="index.php" class="btn btn-success"> <i class="fa fa-angle-double-left"></i>Kembali </a>
                    <a href="form-kembali.php?id_pinjam=<?=$detail['id_pinjam']?>&id_buku=<?=$detail['id_buku']?>" class="btn btn-primary <?php if ($detail['tgl_pinjam']!=NULL) {
                      echo "disasbled";
                   ?>}" role="button">FORM Pengembalian</a>
                  </td>
                </tr>
           </td>
         </tr>
       </table>
     </div>
   </div>
 </div>
 <?php
include '../aset/footer.php';
  ?>
