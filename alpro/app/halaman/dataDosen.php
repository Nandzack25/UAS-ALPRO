<?php 
    require '../init.php';

    // if (!isset($_SESSION["login"]) ){
    //     header("Location: admin.php");
    // }

    $jumlahDataPerHalaman = 4;
    $jumlahData = count(query("SELECT * FROM dosen"));
    $jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);
    $halamanAktif =(isset($_GET["halaman"]) ? $_GET["halaman"] :1);
    $awalData = ($jumlahDataPerHalaman * $halamanAktif)-$jumlahDataPerHalaman;

   $dosen= query("SELECT * FROM dosen LIMIT $awalData, $jumlahDataPerHalaman");

   if(isset($_POST["cari"])){
        $dosen = cariDosen($_POST["keyword"]);
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
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
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

        .search-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .search-form input[type="text"] {
            width: 250px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-form button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .add-button {
            margin-left: auto; 
        }

        .add-button a {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-button a:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="data.php">Data Mahasiswa</a>
            <a href="dataDosen.php">Data Dosen</a>
            <a href="Admin.php" style="float:inline-end" <?php session_destroy();?>>Logout</a>
        </div>
        <div class="search-form">
            <form action="" method="post">
                <input type="text" name="keyword" size="35" autofocus placeholder="Masukkan keyword pencarian" autocomplete="off">
                <button type="submit" name="cari">Cari!</button>
            </form>
            <div class="add-button">
                <a href="../fungsi/tambahDosen.php">Tambah data Dosen</a>
            </div>
        </div>
        <table>
            <tr>
                <th>No</th>
                
                <th>Nama</th>
                <th>Email</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
            <?php $inc = 1;?>
            <?php foreach($dosen as $dsn): ?>
            <tr>
                <td><?php echo $inc;?></td>
               
                <td><?= $dsn["nama"]?></td>
                <td><?= $dsn["email"]?></td>
                <td>
                    <img src="../../public/img/<?= $dsn["gambar"];?>" width="40">
                </td>
                <td>
                    <a href="../fungsi/ubahDosen.php?id=<?= $dsn["id_dosen"];?>" onclick="return confirm('Yakin?');">Ubah</a> |
                    <a href="../fungsi/hapusDosen.php?id=<?= $dsn["id_dosen"];?>" onclick="return confirm('Yakin?');">Hapus</a>
                </td>
            </tr>
            <?php $inc++;?>
            <?php endforeach;?>
        </table>
        <br>
        <div class="pagination">
            <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>
                <a href="?halaman=<?= $i; ?>" <?php if($i == $halamanAktif) echo 'class="active"'; ?>><?= $i; ?></a>
            <?php endfor; ?>
        
        </div>
    </div>
</body>
</html>
