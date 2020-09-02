<?php 

    if(isset($_POST["username"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $login = "SELECT * FROM clientes WHERE usuario = '{$username}' and senha = '{$password}' ";
        
        $access = mysqli_query($connect, $login);

        if(!$access) {
            die("Falha no login");
        }

        $information = mysqli_fetch_assoc($access);

        if(empty($information)) {
            echo "Usuário ou senha invalido";
        } else {
            $_SESSION["username"] = $information["clienteID"];
            header("location:purchase.php");
        }

        echo $information;
    }
?>