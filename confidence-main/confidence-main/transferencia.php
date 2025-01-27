<?php
    $qbtn = 2;
    $link = ["home.php", "action/logout.php"];
    $botao = ["Home", "Sair"];
    include("header.php");

    require_once 'action/db_connect.php';
    require_once 'action/session.php';
    mysqli_close($connect);
?>

<header class="masthead dados">
    <div class="container d-flex align-items-center flex-column">
        <h1 class="text-center mt-5"> Transferir </h1>
        <form class="mb-5 pt-5" method="POST" action="action/transferir.php">
            <div class="form-row text-center align-items-center">
                <div class="col-6">
                    <label class="sr-only" for="inlineFormInput">Destinatário</label>
                    <input type="text" class="form-control mb-2" name="destinatario" id="inlineFormInput" placeholder="Destinatário" required>
                </div>
                <div class="col-6">
                    <label class="sr-only" for="inlineFormInputGroup">Valor</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">R$</div>
                        </div>
                        <input type="number" class="form-control" name="valor" id="inlineFormInputGroup" placeholder="0,00" required>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" name="transferir" class="btn btn-primary mb-2">Transferir</button>
                </div>
            </div>
        </form>
    </div>
</header>

<script src="js/home.js"></script>

<?php
    include("footer.php");
?>