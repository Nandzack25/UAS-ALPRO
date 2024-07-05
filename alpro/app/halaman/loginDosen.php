<?php 
require '../init.php';

// if (isset($_SESSION["login"]) ){
//     header("Location: HalamanDosen.php");
// }

if(isset($_POST["login"])){
    
    if(loginDosen($_POST)> 0){
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
<title>Manajemen data </title>
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

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

    .container {
        padding: 20px;
    }

    .form-container {
        
        display: -moz-stack;
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

    .form-container .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    .form-container .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    .form-container img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .form-container .container {
        padding: 16px;
    }

    .form-container .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }

    @media screen and (max-width: 300px) {
        .form-container .cancelbtn, .form-container .signupbtn {
            width: 100%;
        }
    }

    .button-container {
        text-align: center;
        margin-top: 50px;
    }

    .button-container button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px;
        border: none;
        cursor: pointer;
        width: 150px;
    }

    .button-container button:hover {
        opacity: 0.8;
    }
</style>
</head>
<body>

<div class="navbar">
  <a href="admin.php">Admin</a>
  <a href="../../public/index.php">Mahasiswa</a>
  <!-- <a href="#contact">contact us</a> -->
</div>



<div class="form-container">
    <form action="" method="post">
        <div class="container">
            <h2 style="text-align: center;">Dosen Login</h2>
            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter email" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit" name="login">Login</button>
            </div>
        </div>
    </form>
</div>


  </body>
</html>

