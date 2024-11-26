<?php

include("config.php");

if (isset($_POST['simpan'])) {

    $id = $_POST['id'];
    $nama = !empty($_POST['nama']) ? $_POST['nama'] : null;
    $alamat = !empty($_POST['alamat']) ? $_POST['alamat'] : null;
    $jk = !empty($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : null;
    $agama = !empty($_POST['agama']) ? $_POST['agama'] : null;
    $sekolah = !empty($_POST['sekolah_asal']) ? $_POST['sekolah_asal'] : null;
    $pegawai = !empty($_POST['pegawai_id']) ? $_POST['pegawai_id'] : null;

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    $newfoto = !empty($foto) ? date('dmYHis') . $foto : null;
    $path = $newfoto ? "uploadphotos/" . $newfoto : null;

    $sql = "UPDATE calon_siswa SET 
                " . ($nama ? "nama='$nama'," : "") . 
                ($alamat ? "alamat='$alamat'," : "") . 
                ($jk ? "jenis_kelamin='$jk'," : "") . 
                ($agama ? "agama='$agama'," : "") . 
                ($sekolah ? "sekolah_asal='$sekolah'," : "") . 
                ($pegawai ? "pegawai_id='$pegawai'," : "") . 
                ($newfoto ? "foto='$newfoto'" : "") . 
            " WHERE id=$id";

    $query = mysqli_query($db, $sql);

    if ($query) {
        if ($newfoto) {
            if (move_uploaded_file($tmp, $path)) {
                $sql_update_foto = "UPDATE calon_siswa SET foto='$newfoto' WHERE id=$id";
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
