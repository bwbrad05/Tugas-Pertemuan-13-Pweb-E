<?php

include("config.php");

if (isset($_POST['daftar'])) {

    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $jk = mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
    $agama = mysqli_real_escape_string($db, $_POST['agama']);
    $sekolah = mysqli_real_escape_string($db, $_POST['sekolah_asal']);
    $pegawai = intval($_POST['pegawai_id']);

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $newfoto = date('dmYHis') . $foto;
    $path = "uploadphotos/" . $newfoto;

    $sql = "INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal, pegawai_id, foto) 
            VALUES ('$nama', '$alamat', '$jk', '$agama', '$sekolah', '$pegawai', NULL)";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $last_id = mysqli_insert_id($db);

        if (!empty($foto) && move_uploaded_file($tmp, $path)) {
            $sql_update_foto = "UPDATE calon_siswa SET foto = '$newfoto' WHERE id = $last_id";
            if (!mysqli_query($db, $sql_update_foto)) {
                die("Failed to update photo in the database.");
            }
        }

        header('Location: index.php?status=sukses');
    } else {
        header('Location: index.php?status=gagal');
    }

} else {
    die("Access Denied");
}

?>
