<?php 
session_start();
//koneksi utama
$conn= new mysqli('localhost','root','','ujian');

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// function register($data){
//     global $conn;

//     $username = $data["name"];
//     $nim = $data["nim"];
//     $email = ($data["email"]);
//     $password =  mysqli_real_escape_string($conn,$data["password"]);
//     $password2 =  mysqli_real_escape_string($conn,$data["password2"]);

//     if($password != $password2){
//         echo
//             "<script>
//                 alert('konfirmasi pasword tidak sesuai!');
//             </script>"
//         ;
//         return false;
//     }

//     $result = mysqli_query($conn,"SELECT * nim FROM user WHERE nim = '$nim'" );

//     if(mysqli_fetch_assoc($result)){
//         echo
//         "<script>
//             alert('maaf, Nomor induk mahasiswa sudah terdaftar !');
//         </script>"
//     ;
//         return false;
//     }

//     $password = password_hash($password, PASSWORD_DEFAULT);

//     mysqli_query( $conn,"INSERT INTO user VALUES('','$username','$nim','$email','$password')");

//     return mysqli_affected_rows($conn);
// }

function login($data){
    global $conn;
    $nim = $data["nim"];
    $password = $data["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE nim = '$nim'");

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        $id = $row["id_mhs"];

       if(password_verify($password, $row["password"])){
        $_SESSION['login'] = true;
        header("Location: ../app/halaman/halamanUser.php?id=$id");
        
        exit;
       }
    }

}
function loginAdmin($data){
    global $conn;
    $email = $data["email"];
    $password = $data["password"];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);

       if($password === $row["password"]){
        $_SESSION['login'] = true;
        header("Location: ../halaman/data.php");
        exit; 
       }
    }

}


function tambah($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $NIM  = htmlspecialchars($data["NIM"]);
    $jurusan  = htmlspecialchars($data["jurusan"]);
    $email  = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);

    $password = password_hash($password, PASSWORD_DEFAULT);
    $gambar = upload();
    if(!$gambar){
        return false;
    }

   
    $query = "INSERT INTO user
                VALUES
            ('','$nama','$NIM','$jurusan','$email','$password','$gambar')
    
    " ;
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
 }
 function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $sizeFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4){
        echo 
        "<script>
            alert('Tolong masukan gambar terlebih dahulu!');
        </script>";
        return false;
    }

    $gambarValid =['jpg','png','jpeg'];
    $gambar = explode('.', $namaFile);
    $gambar =strtolower(end($gambar));

    if(!in_array($gambar,$gambarValid)){
        echo 
        "<script>
            alert('Maaf yang anda upload bukan gambar!');
        </script>";
        return false;
    }

    if($sizeFile > 2048000){
        echo 
        "<script>
            alert('Maaf gambar yang anda upload ukurannya terlalu besar!');
        </script>";
        return false;
    }

    $namaFileBaru =uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $gambar;

    

    move_uploaded_file($tmpName, '../../public/img/' . $namaFileBaru);

    return $namaFileBaru;

    


 }

 function hapus($id){
    global $conn;

    $file = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM user WHERE id_mhs ='$id'"));
    unlink('../../public/img/' . $file["gambar"]);

    mysqli_query( $conn ,"DELETE FROM user WHERE id_mhs = $id");
    return mysqli_affected_rows($conn);

 }

 function ubah($data){
    global $conn;
    $id = $data["ID"];
    $nama = htmlspecialchars($data["nama"]);
    $NIM  = htmlspecialchars($data["NIM"]);
    $jurusan  = htmlspecialchars($data["jurusan"]);
    $email  = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);
    $passwordQ= "";

    if ($password !== "") {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $passwordQ = "$password";
    }

    $gambarLama  = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE user SET
            nama = '$nama',
            NIM = '$NIM',
            jurusan = '$jurusan',
            email = '$email',
            password = '$passwordQ',
            gambar = '$gambar'
        WHERE id_mhs = $id";

    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

    function cari($keyword){
        $query ="SELECT * FROM user
        WHERE 
        nama LIKE '%$keyword%' OR
        NIM LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%' OR
        email LIKE '%$keyword%' 


        ";
        return query($query);
    }
    function tambahDosen($data){
        global $conn;
        $nama = htmlspecialchars($data["nama"]);
        $email  = htmlspecialchars($data["email"]);
        $password = htmlspecialchars($data["password"]);
    
        $password = password_hash($password, PASSWORD_DEFAULT);
        $gambar = upload();
        if(!$gambar){
            return false;
        }
    
        $query = "INSERT INTO dosen
                    VALUES
                ('','$nama','$email','$password','$gambar')";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    
    
    function hapusDosen($id){
        global $conn;
    
        $file = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM dosen WHERE id_dosen='$id'"));
        unlink('../../public/img/' . $file["gambar"]);
    
        mysqli_query( $conn ,"DELETE FROM dosen WHERE id_dosen = $id");
        return mysqli_affected_rows($conn);
    }
    
    function ubahDosen($data){
        global $conn;
        $id = $data["ID"];
        $nama = htmlspecialchars($data["nama"]);
        $email  = htmlspecialchars($data["email"]);
    
        $password = htmlspecialchars($data["password"]);
        $passwordQ = "";

    
        if ($password !== "") {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $passwordQ = "$password";
        }
    
        $gambarLama  = htmlspecialchars($data["gambarLama"]);
    
        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }
    
        $query = "UPDATE dosen SET

                nama = '$nama',
                email = '$email',
                password = '$passwordQ',
                gambar = '$gambar'
            WHERE id_dosen = $id";
    
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
    
        return mysqli_affected_rows($conn);
    }
    
    function cariDosen($keyword){
        $query ="SELECT * FROM dosen
            WHERE 
            nama LIKE '%$keyword%' OR
            email LIKE '%$keyword%'";
    
        return query($query);
    }

   
    function getKelasByDosen($id_dosen) {
        global $conn;
    

        $query = "SELECT id_kelas FROM kelas WHERE id_dosen = $id_dosen";
        $result_kelas = mysqli_query($conn, $query);
    
     
        if (!$result_kelas) {
            return [];
        }
    
   
        $mahasiswa = [];
        while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
            $id_kelas = $row_kelas['id_kelas'];
    
            $query_mahasiswa = "SELECT * FROM user WHERE id_mhs IN (SELECT id_mhs FROM daftar_kelas WHERE id_kelas = $id_kelas)";
            $result_mahasiswa = mysqli_query($conn, $query_mahasiswa);
    
          
            while ($row_mahasiswa = mysqli_fetch_assoc($result_mahasiswa)) {
                $mahasiswa[] = $row_mahasiswa;
            }
        }
    
        return $mahasiswa;
    }


function loginDosen($data) {
    global $conn;

    $email = mysqli_real_escape_string($conn, $data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);

    $query = "SELECT * FROM dosen WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["id_dosen"];

        if (password_verify($password, $row["password"])) {
            $_SESSION['login'] = true;
            header("Location: ../halaman/HalamanDosen.php?id=$id");
            
            exit;
        }
    }

    return false;
}


?>
