<?php 
    require_once("../connect/connection.php");

    session_start();

    if(isset($_SESSION["usuario"])){
        // Excluir a variavel de sessão 
        unset($_SESSION["usuario"]);       
        // Destroi todas as variveis de sessão 
        session_destroy();
    }    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index/index.css">
        <link rel="stylesheet" href="_css/login/login_style.css">
        <title>Andes Coffee</title>
    </head>
    <style>
        main {
            width: 90%;
            margin: 110px auto;
        }
        main h1 {
            font-size: 40px;
            text-align: center;
            background-color: white;
            padding: 50px;
            color: var(--color-button-green);
        }
    </style>
    <body>
        <?php require_once("partials/index/header.php"); ?>

        <main>
            <div class="content">
                <h1>You have been disconnected</h1>
            </div>
        </main> 
               
        <?php require_once("partials/index/footer.php") ?>
    </body>
    <script>
        setTimeout(() => {
            location = "index.php"
        }, 2000);
    </script>
</html>
<?php mysqli_close($connect); ?>