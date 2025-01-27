<?php
    require_once 'db_connect.php';
    require_once 'session.php';

    if(isset($_POST['transferir']))
    {
        $destinatario = mysqli_escape_string($connect, $_POST['destinatario']);

        if($destinatario != $dados['usuario'])
        {
            $id_remetente = $dados['id'];
            $valor = mysqli_escape_string($connect, $_POST['valor']);
            date_default_timezone_set('America/Sao_Paulo');
            $horario = date('Y/m/d H:i:s');

            $sql = "SELECT id, saldo FROM usuarios WHERE usuario = '$destinatario'";
            $result = mysqli_query($connect, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                $dados_destinatario = mysqli_fetch_array($result);
                $id_destinatario = $dados_destinatario['id'];
                
                if($valor <= $dados['saldo'])
                {
                    $sql = "INSERT INTO registros (id_remetente, id_destinatario, valor, horario) VALUES ('$id_remetente', '$id_destinatario', '$valor', '$horario')";
                    $saldo_remetente = $dados['saldo'] - $valor;
                    $saldo_destinatario = $dados_destinatario['saldo'] + $valor;

                    if(mysqli_query($connect, $sql))
                    {
                        $sql = "UPDATE usuarios SET saldo = '$saldo_remetente' WHERE id = '$id_remetente'";
                        mysqli_query($connect, $sql);

                        $sql = "UPDATE usuarios SET saldo = '$saldo_destinatario' WHERE id = '$id_destinatario'";
                        mysqli_query($connect, $sql);

                        header('Location: ../home.php?transferencia-bem-sucedida');
                    }else
                    {
                        header('Location: ../transferencia.php?falha-na-transferencia');
                    }
                }else
                {
                    header('Location: ../transferencia.php?sem-saldo-para-transferir');
                }
            }else
            {
                header('Location: ../transferencia.php?destinatario-nao-encontrado');
            }
        }else
        {
            header('Location: ../transferencia.php?destinatario-nao-pode-ser-voce-mesmo');
        }   
    }
?>