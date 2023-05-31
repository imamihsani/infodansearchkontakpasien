<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Pasien RSU Amanah Sumpiuh</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="aset/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    
</head>
<body>
<?php 
error_reporting(0);
?>
<div class="container-fluid mt-3">
    <div class="card mt-2" style="border:none">
        <div class="alert alert-info mt-2" role="alert">
            <h4 class="text-center">Pasien Terdaftar Perhari</h4>
        </div>
        <hr>
        <div class="card mt-1">
            <div class="card mt-2 mb-2 inline">
                <div class="row">
                    <div class="col-6">
                        <form method="get">
                            <div class="card-body">
                                <label>PILIH TANGGAL</label>
                                <div class="modal-header">
                                <input type="date" name="TANGGALKUNJUNGAN" class="form-control" value=""><p style="visibility:hidden">s</p>
                                <button type="submit" value="FILTER" class="btn btn-warning inline"> Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="card-body float-end">
                            <label></label><br>
                            <!-- <button class="btn btn-success"> Expor ke Excel</button> -->
                        </div>
                    </div>
                </div>
            </div>
            
            <table class="table table-bordered table-striped" id="DataTable">
                <thead class="table-info">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Poli</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">WhatsApp Number(with country code)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include "connection.php";

                    if(isset($_GET['TANGGALKUNJUNGAN'])){
                        $tampildatapasien = $_GET['TANGGALKUNJUNGAN'];
                        $ambildatapasien = mysqli_query($connection, "SELECT * FROM PasienHarian WHERE TANGGALKUNJUNGAN='$tampildatapasien' LIMIT 500");
                    }else{
                        $ambildatapasien = mysqli_query($connection,"SELECT * FROM PasienHarian WHERE TANGGALKUNJUNGAN='$tampildatapasien' LIMIT 500");
                    }
                    while ($tampildatapasien = mysqli_fetch_array($ambildatapasien)) { 
            
                    ?>
                
                    <tr>
                        <th scope="row"><?php echo $tampildatapasien['ID']; ?></th>
                        <td><?php echo $tampildatapasien['TANGGALKUNJUNGAN']; ?></td>
                        <td><?php echo $tampildatapasien['NAMA']; ?></td>
                        <td><?php echo $tampildatapasien['POLI']; ?></td>
                        <td><?php echo $tampildatapasien['CARABAYAR']; ?></td>
                        <td><?php echo $tampildatapasien['CONTACT']; ?></td>
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Poli</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">No. WA</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
        
</body>
    <script src="aset/js/bootstrap.min.js"></script>
  
    <script type="text/javascript">
     $(document).ready(function() {
        $('#DataTable').DataTable( {
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf', 'print']
        } );} );
    </script>
</html>