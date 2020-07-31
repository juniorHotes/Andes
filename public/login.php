<?php 
    require_once("../connect/connection.php");

    session_start();

    if(isset($_POST["usuario"])){
        $username = $_POST["usuario"];
        $password = $_POST["senha"];
        
        $access = "SELECT * ";
        $access .= "FROM clientes ";
        $access .= "WHERE usuario = '{$username}' and senha = '{$password}' ";
        
        $logon = mysqli_query($connect, $access);
        
        if(!$logon){
            die("Failed to query database.");
        }
        
        $user = mysqli_fetch_assoc($logon);
        
        if(empty($user)){
            echo "User not registered";
        } else {
            $_SESSION["usuario"] = $user["clienteID"];
            header("location:index.php");
        }        
    }

    if(isset($_SESSION["usuario"])) {
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index.css">
        <link rel="stylesheet" href="_css/login_style.css">
        <title>Andes Coffee - login</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <div class="login-content show-login">
                <div class="login-window">
                    <form action="login.php" method="POST">
                        <h2>Enter your user</h2>
                        <input type="text" name="usuario" placeholder="User name" autofocus>
                        <input type="password" name="senha" placeholder="Password">
                        <input type="submit" value="login">
                        <a href="sign_up.php">Sign Up</a>
                    </form>
                </div>
            </div>
        </main>        
        <?php require_once("partials/footer.php") ?>
        <script src="js/addToCart.js"></script>
    </body>
</html>
<?php mysqli_close($connect); ?>