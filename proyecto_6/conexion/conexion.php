<?php
     $mysqli = new mysqli("127.0.0.1",  "root", "12345678", "proyectof6");
     if(mysqli_connect_errno()){
        echo "ERORR";
    }
/*

    else {
        $mysqli-> close();
        echo "Conexión exitosa";
    }
*/


?>