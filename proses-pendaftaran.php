<?php

include("config.php");

if (isset($_POST['simpan'])) {

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah = $_POST['sekolah_asal'];
    $pegawai = $_POST['pegawai_id'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    $newfoto = date('dmYHis') . $foto;
    $path = "uploadphotos/" . $newfoto;

    $sql = "UPDATE calon_siswa SET 
                nama = '$nama', 
                alamat = '$alamat', 
                jenis_kelamin = '$jk', 
                agama = '$agama', 
                sekolah_asal = '$sekolah', 
                pegawai_id = '$pegawai' 
            WHERE id = $id";

    $query = mysqli_query($db, $sql);

    if ($query) {
        if (!empty($foto)) {
            if (move_uploaded_file($tmp, $path)) {
                $sql_update_foto = "UPDATE calon_siswa SET foto = '$newfoto' WHERE id = $id";
                if (!mysqli_query($db, $sql_update_foto)) {
                    die("Failed to update photo in the database.");
                }
            } else {
                die("Failed to upload photo.");
            }
        }

        header('Location: list-siswa.php');
        exit;
    } else {
        die("Changes not saved: " . mysqli_error($db));
    }

} else {
    die("Access Denied");
}

?>
