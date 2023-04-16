<?php include('config.php'); ?>


<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Edit Data</font>
	</center>

	<hr>

	<?php
	//jika sudah mendapatkan parameter GET id dari URL
	if (isset($_GET['idpegawai'])) {
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$idpegawai = $_GET['idpegawai'];

		//query ke database SELECT tabel mahasiswa berdasarkan id = $id
		$select = mysqli_query($koneksi, "SELECT * FROM administrasi WHERE idpegawai='$idpegawai'") or die(mysqli_error($koneksi));

		//jika hasil query = 0 maka muncul pesan error
		if (mysqli_num_rows($select) == 0) {
			echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
			exit();
			//jika hasil query > 0
		} else {
			//membuat variabel $data dan menyimpan data row dari query
			$data = mysqli_fetch_assoc($select);
		}
	}
	?>

	<?php
	//jika tombol simpan di tekan/klik
	if (isset($_POST['submit'])) {
		$idpegawai			  = $_POST['idpegawai'];
		$nama	= $_POST['nama'];
		$umur	= $_POST['umur'];

		$sql = mysqli_query($koneksi, "UPDATE administrasi SET nama='$nama', umur='$umur' WHERE idpegawai='$idpegawai'") or die(mysqli_error($koneksi));

		if ($sql) {
			echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?page=tampiladmin";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
		}
	}
	?>

	<form action="index.php?page=editadmin&idpegawai=<?php echo $idpegawai; ?>" method="post">
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Nim</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="idpegawai" class="form-control" size="4" value="<?php echo $data['idpegawai']; ?>" readonly required>
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
				<a href="index.php?page=tampiladmin" class="btn btn-warning">Kembali</a>
			</div>
		</div>
	</form>
</div>