<?php
    $server = "localhost";
    $usr = "root";
    $pwd = "";
    $db = "confidence";

    $connect = mysqli_connect($server, $usr, $pwd, $db);

    if(mysqli_connect_error())
    {
        echo "Erro de conexão!".mysqli_connect_error();
    }
?>