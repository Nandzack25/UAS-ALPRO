<?php

require "../init.php";

// if (!isset($_SESSION["login"]) ){
//     header("Location: ../../public/index.php");
// }

$id_mahasiswa = $_GET["id"];


$query = "
    SELECT k.id_kelas, d.nama AS nama_dosen, m.nama_matkul, m.SKS
    FROM kelas k
    INNER JOIN dosen d ON k.id_dosen = d.id_dosen
    INNER JOIN mata_kuliah m ON k.id_matkul = m.id_mata_kuliah
    LEFT JOIN daftar_kelas dk ON k.id_kelas = dk.id_kelas AND dk.id_mhs = $id_mahasiswa
    WHERE dk.id_kelas IS NULL
";

$kelas_belum_diikuti = query($query);


    if(isset($_POST["submit"])){
        $id_mahasiswa = $_POST['id_mahasiswa'];
        $id_kelas = $_POST['id_kelas'];
        
        $addQuery = "INSERT INTO daftar_kelas (id_mhs, id_kelas) VALUES ('$id_mahasiswa', '$id_kelas')";
        $result = mysqli_query($conn, $addQuery);

        if($result) {
            echo "<script>alert('Kelas berhasil didaftarkan!');</script>";
        } else {
            echo "<script>alert('Gagal mendaftarkan kelas!');</script>";
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1200px; 
            margin: auto; 
            padding: 20px;
        }

        table {
            width: 100%; 
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            padding: 20px;
            margin-bottom: 20px;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="../../public/index.php" style="float:inline-end">Logout</a>
            <a href="halamanUser.php?id=<?=$id_mahasiswa?>" >kembali</a>
        </div>
        <h2>Kelas yang Belum Diikuti</h2>

            <table>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Nama Dosen</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
                <?php $inc = 1; ?>
                <?php foreach ($kelas_belum_diikuti as $kelas): ?>
                    <tr>
                        <td><?php echo $inc; ?></td>
                        <td><?php echo htmlspecialchars($kelas['nama_matkul']); ?></td>
                        <td><?php echo htmlspecialchars($kelas['nama_dosen']); ?></td>
                        <td><?php echo htmlspecialchars($kelas['SKS']); ?></td>
                        <td>
                            <form action="" method="post" class="add-button">
                                <input type="hidden" name="id_mahasiswa" value="<?php echo $id_mahasiswa; ?>">
                                <input type="hidden" name="id_kelas" value="<?php echo $kelas['id_kelas']; ?>">
                                <button type="submit" name="submit">daftar</button>
                            </form>
                        </td>
                    </tr>
                    <?php $inc++?>
                <?php endforeach; ?>
            </table>
            <br>
    </div>
</body>
</html>
