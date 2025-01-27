<?php
    $qbtn = 2;
    $link = ["transferencia.php", "action/logout.php"];
    $botao = ["Transferir", "Sair"];
    include("header.php");

    require_once 'action/db_connect.php';
    require_once 'action/session.php';
?>

<header class="info-bar bg-dark">
    <div class="container py-4">
        <div class="saldo">
            <h3 class="text-primary px-5">R$<?php echo number_format($dados['saldo'], 2, ',', ' '); ?></h3>
        </div>
        <h3 class="text-white"><?php echo $dados['usuario'] ?></h3>
    </div>
</header>

<section class="py-5 dados">
    <div class="container">
        <h1 class="text-center mb-5"> Registros </h1>
        <table class="table table-borderless table-light">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Remetente</th>
                    <th scope="col">Destinatário</th>
                    <th scope="col">Data</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    $sql = "SELECT rem.usuario as oremetente, dest.usuario as odestinatario, reg.horario as ohorario, reg.valor as ovalor FROM usuarios rem JOIN registros reg ON rem.id = reg.id_remetente JOIN usuarios dest ON dest.id = reg.id_destinatario ORDER BY reg.horario";
                    $result = mysqli_query($connect, $sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($registros = mysqli_fetch_array($result))
                        {
                            echo    "<tr>
                                        <td>".$registros['oremetente']."</td>
                                        <td>".$registros['odestinatario']."</td>
                                        <td>".$registros['ohorario']."</td>
                                        <td>R$".$registros['ovalor']."</td>
                                    </tr>";
                        }
                    }else
                    {
                        echo    "<tr>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>--/--</td>
                                    <td>R$-,--</td>
                                </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</section>

<script src="js/home.js"></script>

<?php
    mysqli_close($connect);
    include("footer.php");
?>