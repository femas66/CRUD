<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-weight: bold;
        }
    </style>
    <link rel="icon" type="image/x-icon" href="img/logo.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>CRUD</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/83685fdc33.js" crossorigin="anonymous"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #37306B;">
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                <i class="fa-solid fa-person"></i>
                    <span>Data Warga</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="halaman-pekerjaan.php">
                <i class="fa-solid fa-sack-dollar"></i>
                    <span>Data Pekerjaan</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="halaman-hobi.php">
                <i class="fa-solid fa-gamepad"></i>
                    <span>Data Hobi</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="halaman-vaksin.php">
                <i class="fa-solid fa-syringe"></i>
                    <span>Data Vaksin</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="halaman-agama.php">
                <i class="fa-solid fa-person-praying"></i>
                    <span>Data Agama</span></a>
            </li>            
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                
                <h1 style="font-weight: bold; color:black;">Dashboard</h1>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fa-solid fa-user"></i> <?= ucfirst($_SESSION['name']) ?></span>
                            
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                               
                                <a class="dropdown-item" href="ganti-password.php">
                                <i class="fa-solid fa-key"></i>
                                    Ganti Password
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
<?php
$q = $koneksi->query("SELECT * FROM warga");

    ?>                
                    <!-- Page Heading -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><a href="tambah-warga.php" class="btn" style="background: #37306B; font-weight: bold; color:white; border-radius: 18px;"><i class="fa-solid fa-plus"></i> Tambah Data Warga</a></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 100px;">Foto</th>
                                            <th>Nama</th>
                                            <th>Status nikah</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($q->num_rows > 0) {
                                            $i = 1;
                                            while ($data = $q->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><img src="gambar/<?= $data['foto'] ?>" width="80" height="80" style="border-radius: 100%;"></td>
                                                    <td><?= $data['nama'] ?></td>
                                                    <td><?= ($data['nikah'] == 'Y') ? "Sudah nikah" : "Belum nikah" ?></td>
                                                    <td><?= ($data['jenis_kelamin'] == 'L') ? 'Laki laki' : 'Perempuan' ?></td>
                                                    
                                                    <td><?= $data['tanggal_lahir'] ?></td>
                                                    <td><a href="edit-warga.php?id=<?= $data['id'] ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a></td>
                                                    <td><a href="?id_hapus=<?= $data['id'] ?>"><i class="fa-solid fa-trash"></i> Hapus</a></td>
                                                    
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'><center>Tidak ada data</center></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Yakin mau logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php" style="color: black;"><b>Logout</b></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php
if (isset($_GET['id_hapus'])) {
  ?>
  <script>
    Swal.fire({
      title: 'Yakin mau hapus?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "hapus-data.php?hapus_warga=<?= $_GET['id_hapus'] ?>";
      }
    })
  </script>
  <?php  
}