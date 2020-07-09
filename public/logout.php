<?php 
    require_once("../connect/connection.php");

    session_start();

    if(isset($_SESSION["usuario"])){
        // Excluir a variavel de sessão 
        unset($_SESSION["usuario"]);       
        // Destroi todas as variveis de sessão 
        session_destroy();
    }
       
    header("location:index.php");
    
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
        </main>        
        <?php require_once("partials/footer.php") ?>
    </body>
</html>
<?php mysqli_close($connect); ?>