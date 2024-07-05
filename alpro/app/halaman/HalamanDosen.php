<?php

    require "../init.php";
    // if (!isset($_SESSION["login"]) ){
    //     header("Location: loginDosen.php");
    // }

$id_dosen = $_GET["id"];


$kelasList = getKelasByDosen($id_dosen);


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
            <!-- <a href="data.php">Data Mahasiswa</a> -->
            <a href="LoginDosen.php" style="float:inline-end" <?php session_destroy();?>>Logout</a>
        </div>
        <h2>Kelas yang Diajar</h2>

            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nomor induk mahasiswa</th>
                    <th>Jurusan</th>
                </tr>
                <?php
                 $inc = 1;
                ?>
                <?php foreach ($kelasList as $mahasiswa): ?>
                    <tr>
                        <td><?php echo $inc; ?></td>
                        <td><?php echo htmlspecialchars($mahasiswa['nama']); ?></td>
                        <td><?php echo htmlspecialchars($mahasiswa['NIM']); ?></td>
                        <td><?php echo htmlspecialchars($mahasiswa['jurusan']); ?></td>
                    </tr>
                    <?php $inc++; ?>
                <?php endforeach; ?>
            </table>
            <br>
    </div>
</body>
</html>
