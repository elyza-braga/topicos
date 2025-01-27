<?php
    require_once 'db_connect.php';

    if(isset($_POST['cadastrar']))
    {
        $email = mysqli_escape_string($connect, $_POST['email']);
        $usuario = mysqli_escape_string($connect, $_POST['usuario']);
        $senha = md5(mysqli_escape_string($connect, $_POST['senha']));

        $sql = "INSERT INTO usuarios (email, usuario, senha, saldo) VALUES ('$email', '$usuario', '$senha', 0.0)";

        if(mysqli_query($connect, $sql))
        {
            header('Location: ../index.php?sucesso');
        }else
        {
            header('Location: ../index.php?falha');
        }
    }
?>