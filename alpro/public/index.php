
<?php 


require '../app/init.php';

// if (isset($_SESSION["login"]) ){
//     header("Location: ../app/halaman/halamanUser.php");
// }

  if(isset($_POST["login"])){
    
    if(login($_POST)> 0){
      echo
      "<script>
        alert('Login berhasil');
      </script>";
    }
    else{
      echo mysqli_error($conn);
      echo
      "<script>
        alert('Login gagal, Email atau Password salah.');
      </script>";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>manajeman data</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .navbar {
        
        overflow: hidden;
        background-color: #333;
    }

    .navbar a {
        
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 20px 20px;
        text-decoration: none;
    }

    .container {
        padding: 20px;
    }

    .form-container {
        max-width: 300px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-container input[type=text], 
    .form-container input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .form-container button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .form-container button:hover {
        opacity: 0.8;
    }

    .form-container .button-container {
        text-align: center;
        margin-top: 20px;
    }

    .form-container .button-container a {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        margin: 0 10px;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .form-container .button-container a:hover {
        opacity: 0.8;
    }
</style>
</head>
<body>

<div class="navbar">
  <a href="../app/halaman/admin.php">Admin</a>
  <a href="../app/halaman/loginDosen.php">Dosen</a>
  <!-- <a href="#contact">Contact Us</a> -->
</div>
        <div class="form-container">
            <form action="" method="post">
                <div class="container">
                <h2 style="text-align: center;">Login Mahasiswa</h2>

                    <div class="container">
                        <label for="nim"><b>NIM</b></label>
                        <input type="text" placeholder="Enter NIM" name="nim" required>

                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>

                        <button type="submit" name="login">Login</button>
                    </div>
                </div>
            </form>
        </div>
</div>

</body>
</html>
