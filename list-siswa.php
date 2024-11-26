<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa Baru</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Faculty+Glyphic&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Faculty Glyphic', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f8fb;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background: linear-gradient(135deg, #4682B4, #87CEEB);
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        header h3 {
            font-family: 'Faculty Glyphic', Arial, sans-serif;
            font-size: 24px;
            margin: 0;
        }

        nav {
            margin: 20px 0;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: #4682B4;
            background-color: #f0f8ff;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #4682B4;
            color: white;
        }

        table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4682B4;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        p {
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
        }

        .section-header {
            margin-top: 40px;
        }

        img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <header>
        <h3>Daftar Siswa yang Telah Mendaftar</h3>
    </header>

    <nav>
        <a href="form-daftar.php">[+] Tambah Baru</a>
    </nav>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Sekolah Asal</th>
                <th>Pegawai yang melayani</th>
                <th>Foto</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT calon_siswa.*, pegawai.nama AS pegawai_nama 
                    FROM calon_siswa
                    LEFT JOIN pegawai ON calon_siswa.pegawai_id = pegawai.id";
            $query = mysqli_query($db, $sql);
            while ($siswa = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>".$siswa['id']."</td>";
                echo "<td>".$siswa['nama']."</td>";
                echo "<td>".$siswa['alamat']."</td>";
                echo "<td>".$siswa['jenis_kelamin']."</td>";
                echo "<td>".$siswa['agama']."</td>";
                echo "<td>".$siswa['sekolah_asal']."</td>";
                echo "<td>".$siswa['pegawai_nama']."</td>"; 
                
                if (!empty($siswa['foto'])) {
                    echo "<td><img src='uploadphotos/".$siswa['foto']."' alt='Foto'></td>";
                } else {
                    echo "<td>No Photo</td>";
                }

                echo "<td>";
                echo "<a href='form-edit.php?id=".$siswa['id']."'>Edit</a> | ";
                echo "<a href='hapus.php?id=".$siswa['id']."'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <p>Total: <?php echo mysqli_num_rows($query); ?></p>

    <header class="section-header">
        <h3>Daftar Pegawai</h3>
    </header>
    
    <table>
        <thead>
            <tr>
                <th>ID Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_pegawai = "SELECT * FROM pegawai";
            $query_pegawai = mysqli_query($db, $sql_pegawai);
            while ($pegawai = mysqli_fetch_array($query_pegawai)) {
                echo "<tr>";
                echo "<td>".$pegawai['id']."</td>";
                echo "<td>".$pegawai['nama']."</td>";
                echo "<td>".$pegawai['jabatan']."</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
        if (isset($_GET['message'])) {
            echo "<p style='color: green; font-weight: bold;'>Delete Successful!</p>";
        }
    ?>
</body>
</html>
