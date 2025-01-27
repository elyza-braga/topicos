<?php
    $qbtn = 2;
    $link = ["#cadastro",""];
    $botao = ["Cadastro","Login"];
    include("header.php");

    require_once 'action/db_connect.php';

    session_start();

    if(isset($_SESSION['logado']))
    {
        header("Location: home.php");
    }

    $erros = array();

    if(isset($_POST['logar']))
    {
        $usuario = mysqli_escape_string($connect, $_POST['usuarioL']);
        $senha = md5(mysqli_escape_string($connect, $_POST['senhaL']));

        if(empty($usuario) || empty($senha))
        {
            $erros[] = "Login e senha precisam estar preenchidos";
        }else
        {
            $sql = "SELECT usuario FROM usuarios WHERE usuario = '$usuario'";
            $result = mysqli_query($connect, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
                $result = mysqli_query($connect, $sql);
                if(mysqli_num_rows($result) == 1)
                {
                    $dados = mysqli_fetch_array($result);
                    mysqli_close($connect);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    header('location: home.php');
                }else
                {
                    $erros[] = "Usuário ou senha incorretos";
                }
            }else
            {
                $erros[] = "Usuário ou senha incorretos";
            }
        }
    }

?>

<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image--><img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="" /><!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">Confidence</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">Criptomoeda Fácil</p>
    </div>
</header>

<section class="masthead bg-light text-dark" id="cadastro">
    <h1 class="masthead-heading text-center text-uppercase mb-0">Cadastro</h1>
    <form class="container my-5 pt-5" method="POST" action="action/cad_cliente.php">
        <div class="form-group">
            <label for="usuario">Usuário</label>
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="nome de usuario" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="exemplo@email.com" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" name="senha" id="senha" placeholder="*****" required>
        </div>
        <button name="cadastrar" type="submit" class="btn btn-primary mx-auto">Enviar</button>
    </form>
</section>

<?php
    if(!empty($erros))
    {
        $text_error = "";
        foreach($erros as $erro)
        {
            $text_error = $text_error.$erro."\\n";
        }
        echo "<script> alert('".$text_error."'); </script>";
    }
?>

<!-- Login Modal-->
<div class="portfolio-modal modal fade" id="loginBox" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Login Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase text-center mb-0 mt-5">Login</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Login Modal - Image-->
                            <form class="container mb-5 pt-5" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="form-group">
                                    <label for="usuario">Usuário</label>
                                    <input type="text" class="form-control" name="usuarioL" id="usuarioL" placeholder="nome de usuario" required>
                                </div>
                                <div class="form-group">
                                    <label for="senha">Senha</label>
                                    <input type="password" class="form-control" name="senhaL" id="senhaL" placeholder="*****" required>
                                </div>
                                <div class="text-center">
                                    <button name="logar" type="submit" class="btn btn-primary mt-3">Entrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/index.js"></script>

<?php include("footer.php"); ?>