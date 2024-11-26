<?php

include("config.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM calon_siswa WHERE id=$id";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $decrementSql = "UPDATE calon_siswa SET id = id - 1 WHERE id > $id";
        $decrementQuery = mysqli_query($db, $decrementSql);

        if ($decrementQuery) {
            $resetAutoIncrementSql = "ALTER TABLE calon_siswa AUTO_INCREMENT = 1";
            mysqli_query($db, $resetAutoIncrementSql);

            header('Location: list-siswa.php?message=Delete Successful and IDs Decremented!');
        } else {
            die("ID Decrement Failed!");
        }
    } else {
        die("Delete Failed!");
    }

} else {
    die("Access denied");
}

?>
