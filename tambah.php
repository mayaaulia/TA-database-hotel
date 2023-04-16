<?php include('config.php'); ?>

<center>
	<font size="6">Tambah Data</font>
</center>
<hr>
<?php
if (isset($_POST['submit'])) {
	$idpegawai			= $_POST['idpegawai'];
	$nama			= $_POST['nama'];
	$umur	= $_POST['umur'];

	$cek = mysqli_query($koneksi, "SELECT * FROM administrasi WHERE idpegawai='$idpegawai'") or die(mysqli_error($koneksi));

	if (mysqli_num_rows($cek) == 0) {
		$sql = mysqli_query($koneksi, "INSERT INTO administrasi(idpegawai, nama, umur) VALUES('$idpegawai', '$nama', '$umur')") or die(mysqli_error($koneksi));

		if ($sql) {
			echo '<script>alert("Berhasil menambahkan data."); document.location="index.php?page=tampiladmin";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
		}
	} else {
		echo '<div class="alert alert-warning">Gagal, idpegawai sudah terdaftar.</div>';
	}
}
?>

<form action="index.php?page=tambahadmin" method="post">
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Id Pegawai</label>
		<div class="col-md-6 col-sm-6">
			<input type="text" name="idpegawai" class="form-control" size="4" value="<?php echo $data['idpegawai']; ?>" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Nama</label>
		<div class="col-md-6 col-sm-6">
			<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Usia</label>
		<div class="col-md-6 col-sm-6">
			<input type="text" name="umur" class="form-control" value="<?php echo $data['umur']; ?>" required>
		</div>
	</div>
	<div class="item form-group">
		<div class="col-md-6 col-sm-6 offset-md-3">
			<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
		</div>
</form>