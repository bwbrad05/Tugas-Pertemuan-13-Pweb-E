<?php

$server = "sql311.infinityfree.com";
$user = "if0_37739435";
$password = "CKRol0PSJs";
$nama_database = "if0_37739435_daftar_siswa";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Failed to read the database: " . mysqli_connect_error());
}


?>