<html>
  <head>
    <title>CRUd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/83685fdc33.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/x-icon" href="img/logo.ico">
  </head>
  <body>

  <?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}

$query = $koneksi->query("SELECT * FROM warga WHERE id = '$_GET[id]'");
$data = $query->fetch_array();
?>
<div class="container">
<h3>Edit data</h3><hr><form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama lengkap</label>
      <input type="text" name="nama" placeholder="Nama" class="form-control" value="<?= $data['nama'] ?>" required id="nama">
    </div>
    <div class="mb-3">
      <img src="gambar/<?= $data['foto'] ?>" alt="" width="100" height="100">
      <label for="foto" class="form-label">Foto</label>
      <input type="file" name="foto" id="foto" class="form-control">
    </div>
    <hr>
    <div class="form-check">
      <label for="lbb">Sudah nikah</label>
      <input type="radio" name="nikah" id="lbb" value="Y" class="form-check-input" <?= ($data['nikah'] == 'Y') ? "checked" : "" ?>>
    </div>
    <div class="form-check">
      <label for="pbb">Belum nikah</label>
      <input type="radio" name="nikah" id="pbb" value="N" class="form-check-input" <?= ($data['nikah'] == 'N') ? "checked" : "" ?>>
    </div>
    <hr>
    <div class="form-check">
      <label for="l">Laki laki</label>
      <input type="radio" name="jk" id="l" value="L" class="form-check-input" <?= ($data['jenis_kelamin'] == 'L') ? "checked" : "" ?>>
    </div>
    <div class="form-check">
      <label for="p">Perempuan</label>
      <input type="radio" name="jk" id="p" value="P" class="form-check-input" <?= ($data['jenis_kelamin'] == 'P') ? "checked" : "" ?>>
    </div>
    <hr>
    <div class="mb-3">
      <label for="tgl" class="form-label">Tanggal lahir</label>
      <input type="date" name="tanggal_lahir" id="tgl" placeholder="Tanggal lahir" class="form-control" value="<?= date('Y-m-d', strtotime($data['tanggal_lahir']))?>" required>
    </div>
    <div class="mb-3">

      <button type="submit" name="submit" class="btn" style="background: #37306B; font-weight: bold; color:white; border-radius: 18px;"><i class="fa-solid fa-floppy-disk"></i>  Simpan</button>
    </div>
  </form>
</div>
<?php
if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $nama = $_POST['nama'];
  $nikah = $_POST['nikah'];
  $jenis_kelamin = $_POST['jk'];
  $tanggal_lahir =  date('d-m-Y', strtotime($_POST['tanggal_lahir']));
  $foto = $_FILES['foto']['name'];

  if ($_FILES['foto']['name']) {
    $ambil_data = $koneksi -> query("SELECT foto FROM warga WHERE id = '$id'");
    $data_gambar = $ambil_data->fetch_array();
    unlink('gambar/' . $data_gambar['foto']);
    $folder_gambar = "gambar/";
    $pp = time().$_FILES["foto"]["name"];
    $target_file = $folder_gambar . basename($pp);
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
      $a = $koneksi -> query("UPDATE `warga` SET `nama`='$nama',`foto`='$pp',`nikah`='$nikah',`jenis_kelamin`='$jenis_kelamin',`tanggal_lahir`='$tanggal_lahir' WHERE id = '$_GET[id]'");
      if ($a) {
        ?>
        <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil menyimpan',
        showConfirmButton: false,
        timer: 1000
      }).then(() => {
        window.location = 'index.php';
      })
      </script>
        <?php
      }
      
    } else {
      echo "Gagal mengunggah gambar.";
    }
  }
  else {
    $a = $koneksi -> query("UPDATE `warga` SET `nama`='$nama',`nikah`='$nikah',`jenis_kelamin`='$jenis_kelamin',`tanggal_lahir`='$tanggal_lahir' WHERE id = '$_GET[id]'");
    if ($a) {
    ?>
      <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil menyimpan',
        showConfirmButton: false,
        timer: 1000
      }).then(() => {
        window.location = 'index.php';
      })
      </script>
      <?php
    }
  }
}
?>