<?php 
    require_once("../connect/connection.php");

    session_start();

    if(isset($_POST["usuario"])){
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        
        $login = "SELECT * ";
        $login .= "FROM clientes ";
        $login .= "WHERE usuario = '{$usuario}' and senha = '{$senha}' ";
        
        $acesso = mysqli_query($connect, $login);
        if(!$acesso){
            die("Falha ao consultar banco de dados.");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        
        if(empty($informacao)){
            $mensagem = "Usuário ou senha invalido";
        } else {
            $_SESSION["usuario"] = $informacao["clienteID"];
            header("location:index.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index.css">
        <link rel="stylesheet" href="_css/login_style.css">
        <title>Andes Coffee</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <div class="login-content show-login">
                <div class="login-window">
                    <form action="login.php" method="POST">
                        <h2>Enter your user</h2>
                        <input type="text" name="usuario" placeholder="User name">
                        <input type="password" name="senha" placeholder="Password">
                        <input type="submit" value="login">
                        <a href="sign_up.php">Sign Up</a>
                    </form>
                </div>
            </div>
        </main>        
        <?php require_once("partials/footer.php") ?>
    </body>
</html>
<?php mysqli_close($connect); ?>