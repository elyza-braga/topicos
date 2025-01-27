<?php
    session_start();

    if(isset($_SESSION['logado']))
    {
        $id = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($result);
        //mysqli_close($connect);
    }else
    {
        header("Location: index.php");
    }  
?>