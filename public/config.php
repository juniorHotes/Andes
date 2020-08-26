<?php 
    
    require_once("../connect/connection.php");
    
    session_start();

    $config_type = $_GET['_configType'];

    if($config_type == "RegisterNewProduct") {
        require_once("php/register_new_product.php");

    } else if($config_type == "ChangeProduct") {
        require_once("php/change_product.php");

    } else if($config_type == "RegisterSupplier") {
      //  require_once("php/register-supplier.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index.css">
        <link rel="stylesheet" href="_css/config.css">
        <?php
            if($config_type == "RegisterNewProduct") {
                echo "<link rel='stylesheet' href='_css/register_new_product.css'>";
        
            } else if($config_type == "ChangeProduct") {
                echo "<link rel='stylesheet' href='_css/change_product.css'>";
        
            } else if($config_type == "RegisterSupplier") {
                //require_once("");
            }
        ?> 

        <title>Andes Coffee - Register new product</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <div class="content">
            
                <?php
                    if($config_type == "RegisterNewProduct") {
                        require_once("partials/form_register_new_product.php");
                
                    } else if($config_type == "ChangeProduct") {
                        require_once("partials/form_change_product.php");
                
                    } else if($config_type == "RegisterSupplier") {
                        //require_once("partials/register-supplier.php");
                    }
                 ?> 
            </div>
        </main>        
        <?php require_once("partials/footer.php") ?>
        <script src="js/addToCart.js"></script>
        <script src="js/addToFavorite.js"></script>

        <?php if($config_type == "RegisterNewProduct") { ?>
            <script src="js/file_validation_upload.js"></script>
        <?php } ?>

        <?php 
            if($config_type == "RegisterNewProduct") {
                if($success == 1) { ?>
                    <script>
                        alert("Registered successfully");
                    </script>
        <?php } else if($success == 0) { ?>
                    <script>
                        alert("Failed to register product");
                    </script>
        <?php 
                } 
            } 
        ?>

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