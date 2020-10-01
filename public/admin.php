<?php 
    
    require_once("../connect/connection.php");
    
    session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("partials/index/head_global.php"); ?>
        <link rel="stylesheet" href="_css/admin/admin.css">
        <title>Andes Coffee - Config</title>
    </head>
    <body>
        <?php require_once("partials/index/header.php"); ?>

        <main>
            <div class="content">
                <ul>
                    <li>
                        <a href="config.php?_configType=RegisterNewProduct">
                            <div class="content-btn _hover">                                
                                <img width="150px" src="assets/configuracoes - large.svg" alt="Icon config">
                                <h2>Register new product</h2>
                            </div>
                        </a> 
                    </li> 
                    <li>
                        <a href="config.php?_configType=ChangeProduct">
                            <div class="content-btn _hover">
                                <img width="150px" src="assets/configuracoes - large.svg" alt="Icon config">
                                <h2>Change product</h2>
                            </div>
                        </a> 
                    </li> 
                </ul>
            </div>
        </main>        
        <?php require_once("partials/index/footer.php") ?>
        <script src="js/index/addToCart.js"></script>
        <script src="js/index/getFavorite.js"></script>
    </body>
</html>

<?php mysqli_close($connect); ?>