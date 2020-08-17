<?php 
    require_once("../connect/connection.php");

    session_start();

    $not_registered = "";
    if(isset($_POST["usuario"])){
        $username = $_POST["usuario"];
        $password = $_POST["senha"];
        
        $access = "SELECT * ";
        $access .= "FROM clientes ";
        $access .= "WHERE usuario IN ('{$username}','{$password}','nivel') ";
        
        $logon = mysqli_query($connect, $access);
        
        if(!$logon){
            die("Failed to query database.");
        }
        
        $user = mysqli_fetch_assoc($logon);
        
        if(empty($user)) {
            $not_registered = '<h2 style="color:red; margin-bottom:20px">User not registered</h2>';
        } else {
            $_SESSION["usuario"] = $user["clienteID"];
            $_SESSION["nivel"] = $user["nivel"];
            header("location:index.php");
        }   
    }

    $checkout = "";
    if(isset($_GET["Checkout"])) {
        $checkout = '<h2 style="color:darkseagreen; margin-bottom:20px">To complete your purchase you need to register or login</h2>';
    } else {
        $checkout = "";
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
            <div class="login-content">
                <div class="login-window">
                <?php echo $checkout ?>
                <?php echo $not_registered ?>
                    <form action="login.php" method="POST">
                        <h2>Enter your user</h2>
                        <input type="text" name="usuario" placeholder="User name" required autofocus>
                        <input type="password" name="senha" placeholder="Password" required>
                        <input class="button-hover" type="submit" value="login" title="Submit">
                        <hr>
                        <h4>Don't have an account yet?</h4>
                        <a class="button-hover" href="sign_up.php" title="Sign Up" rel="Sign Up">Sign Up</a>
                    </form>
                </div>
            </div>
        </main>        
        <?php require_once("partials/footer.php") ?>
        <script src="js/addToCart.js"></script>
        <script>
            const favoriteItems = document.querySelector('#favorite-items');

            if (localStorage.getItem("favorites") != null) {
                let fItems = localStorage.getItem("favorites").split(',');
                favoriteItems.innerHTML = fItems.length;
                favoriteItems.parentElement.setAttribute("href", "index.php?favorites=" + fItems);
            }
        </script>
    </body>
</html>
<?php mysqli_close($connect); ?>