<?php 
require '../init.php';

// if (!isset($_SESSION["login"]) ){
//     header("Location: ../halaman/admin.php");
// }


$ID = $_GET["id"];

$mhs = query("SELECT * FROM user WHERE id_mhs = $ID")[0];

    
    if (isset($_POST['submit'])) {
        
        if(ubah($_POST)>0){
          
            echo 
            "<script>
                alert('data berhasil diubah!');
                document.location.href='../halaman/data.php';
            </script>
            ";
        }else{
            echo 
            "<script>
                alert('data gagal diubah!');
                document.location.href='../halaman/data.php';
            </script>
            ";
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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
        }

        form ul {
            list-style: none;
            padding: 0;
        }

        form ul li {
            margin-bottom: 10px;
        }

        label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 130px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="file"] {
            width: calc(100% - 130px);
            padding: 8px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color:  #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #4CAF50;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            padding: 20px;
            margin-bottom: 20px;
        }

        .navbar a {
            float: left;
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
    <div class="navbar">
        <a href="../halaman/dataDosen.php">Kembali ke Data Mahasiswa</a>
    </div>
    <div class="container">
        <h1>Ubah Data Mahasiswa</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ID" value=<?=$mhs['id_mhs']?>>
            <input type="hidden" name="gambarLama" value=<?=$mhs['gambar']?>>
            <ul>
                <li>
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" required value="<?=$mhs['nama']?>">
                </li>
                <li>
                    <label for="nim">NIM:</label>
                    <input type="text" name="NIM" id="nim" required value="<?=$mhs['NIM']?>">
                </li>
                <li>
                    <label for="jrsn">Jurusan:</label>
                    <input type="text" name="jurusan" id="jrsn" required value="<?=$mhs['jurusan']?>">
                </li>
                <li>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" required value="<?=$mhs['email']?>">
                </li>
                <li>
                    <label for="gambar">Gambar:</label>
                    <input type="file" name="gambar" id="gambar">
                </li>
                <li>
                    <label for="pw">Password:</label>
                    <input type="password" name="password" id="pw">
                </li>

                <li>
                    <button type="submit" name="submit">Ubah</button>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>
