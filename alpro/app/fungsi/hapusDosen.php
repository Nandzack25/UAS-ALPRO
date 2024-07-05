<?php 
   require '../init.php';

//    if (!isset($_SESSION["login"]) ){
//     header("Location: ../halaman/admin.php");
// }


   $id = $_GET["id"];
    if(hapusDosen($id)>0) {
        echo 
            "<script>
                alert('data berhasil dihapus!');
                document.location.href='../halaman/dataDosen.php';
            </script>
            ";
    }else{
        echo 
            "<script>
                alert('data gagal dihapus!');
                document.location.href='../halaman/dataDosen.php';
            </script>
            ";
    }
?>