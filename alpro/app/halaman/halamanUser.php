<?php
    require "../init.php";
// if (!isset($_SESSION["login"]) ){
//     header("Location: ../../public/index.php");
// }



$id = $_GET["id"];

$informasi_kelas = array();


$id_kelas_mahasiswa = query("SELECT id_kelas FROM daftar_kelas WHERE id_mhs = $id");

foreach ($id_kelas_mahasiswa as $kelas) {
    $id_kelas = $kelas['id_kelas'];
    $result = query("SELECT dosen.nama AS nama_dosen, mata_kuliah.nama_matkul, mata_kuliah.SKS
                     FROM kelas
                     INNER JOIN dosen ON kelas.id_dosen = dosen.id_dosen
                     INNER JOIN mata_kuliah ON kelas.id_matkul = mata_kuliah.id_mata_kuliah
                     WHERE kelas.id_kelas = $id_kelas");


    foreach ($result as $info_kelas) {
        $informasi_kelas[] = array(
            'nama_dosen' => $info_kelas['nama_dosen'],
            'nama_matkul' => $info_kelas['nama_matkul'],
            'SKS' => $info_kelas['SKS']
        );
}
}
// $mhs = query("SELECT * FROM user WHERE id_mhs = $id");

// $kelas = query("SELECT kelas.*
// FROM kelas
// INNER JOIN daftar_kelas ON kelas.id_kelas = daftar_kelas.id_kelas
// WHERE daftar_kelas.id_mhs = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen data</title>
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
            <a href="daftarKelas.php?id= <?=$id?>" >Tambah Matkul</a>
            <a href="../../public/index.php" style="float:inline-end" <?php session_destroy();?>>Logout</a>
        </div>
        <h2>Kelas yang Dikuti</h2>

            <table>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Nama dosen</th>
                    <th>SKS</th>
                </tr>
                <?php
                 $inc = 1;
                ?>
                <?php foreach ($informasi_kelas as $kls): ?>
                    <tr>
                        <td><?php echo $inc; ?></td>
                        <td><?php echo htmlspecialchars($kls['nama_matkul']); ?></td>
                        <td><?php echo htmlspecialchars($kls['nama_dosen']); ?></td>
                        <td><?php echo htmlspecialchars($kls['SKS']); ?></td>
                    </tr>
                    <?php $inc++; ?>
                <?php endforeach; ?>
            </table>
            <br>
    </div>
</body>
</html>
