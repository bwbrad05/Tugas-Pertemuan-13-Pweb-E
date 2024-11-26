<?php

include("config.php");

if( !isset($_GET['id']) ){
    header('Location: list-siswa.php');
}

$id = $_GET['id'];

$sql = "SELECT * FROM calon_siswa WHERE id=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}

$sql_pegawai = "SELECT id, nama FROM pegawai";
$query_pegawai = mysqli_query($db, $sql_pegawai);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Edit Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Faculty Glyphic', Arial, sans-serif;
            background-image: url("https://image.slidesdocs.com/responsive-images/background/code-technology-dark-data-business-blue-powerpoint-background_a2b80d32ab__960_540.jpg");
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: justify;
        }
        header h3 {
            font-size: 1.8em;
            color: navy;
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        fieldset {
            border: none;
            padding: 0;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        .radio-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            background-color: #2E8B57;
            color: #fff;
            font-size: 1.1em;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #246644;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h3>Formulir Edit Siswa</h3>
        </header>

        <form action="proses-edit.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>" />

                <p>
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" placeholder="Nama lengkap" value="<?php echo $siswa['nama'] ?>" required />
                </p>
                <p>
                    <label for="alamat">Alamat:</label>
                    <textarea name="alamat" rows="4" placeholder="Alamat lengkap" required><?php echo $siswa['alamat'] ?></textarea>
                </p>
                <p>
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <div class="radio-group">
                        <?php $jk = $siswa['jenis_kelamin']; ?>
                        <label><input type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo ($jk == 'Laki-laki') ? "checked": "" ?>> Laki-laki</label>
                        <label><input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo ($jk == 'Perempuan') ? "checked": "" ?>> Perempuan</label>
                    </div>
                </p>
                <p>
                    <label for="agama">Agama: </label>
                    <?php $agama = $siswa['agama']; ?>
                    <select name="agama">
                        <option <?php echo ($agama == 'Islam') ? "selected": "" ?>>Islam</option>
                        <option <?php echo ($agama == 'Kristen') ? "selected": "" ?>>Kristen</option>
                        <option <?php echo ($agama == 'Katolik') ? "selected": "" ?>>Katolik</option>
                        <option <?php echo ($agama == 'Hindu') ? "selected": "" ?>>Hindu</option>
                        <option <?php echo ($agama == 'Budha') ? "selected": "" ?>>Budha</option>
                        <option <?php echo ($agama == 'Kong Hu Cu') ? "selected": "" ?>>Kong Hu Cu</option>
                    </select>
                </p>
                <p>
                    <label for="sekolah_asal">Sekolah Asal:</label>
                    <input type="text" name="sekolah_asal" placeholder="Nama sekolah" value="<?php echo $siswa['sekolah_asal'] ?>" required />
                </p>
                <p>
                    <label for="pegawai_id">Pegawai yang melayani:</label>
                    <select name="pegawai_id">
                        <option value="">-- Pilih Pegawai --</option>
                        <?php while ($pegawai = mysqli_fetch_assoc($query_pegawai)): ?>
                            <option value="<?php echo $pegawai['id']; ?>" <?php echo ($pegawai['id'] == $siswa['pegawai_id']) ? "selected" : ""; ?>>
                                <?php echo $pegawai['nama']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </p>
                <p>
                    <label for="foto">Upload Foto:</label>
                    <input type="file" name="foto" accept="image/*" required />
                </p>
                <p style="text-align: center;">
                    <input type="submit" value="Simpan" name="simpan" />
                </p>
            </fieldset>
        </form>
    </div>
</body>
</html>
