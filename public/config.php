<?php 
    
    require_once("../connect/connection.php");
    
    session_start();

    $config_type = $_GET['_configType'];

    if($config_type == "RegisterNewProduct") {
        require_once("php/admin/register_new_product.php");

    } else if($config_type == "ChangeProduct") {
        require_once("php/admin/change_product.php");

    } else if($config_type == "RegisterSupplier") {
        require_once("php/admin/register_supplier.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index/index.css">
        <link rel="stylesheet" href="_css/admin/config.css">
        <?php
            if($config_type == "RegisterNewProduct") {
                echo "<link rel='stylesheet' href='_css/admin/register_new_product.css'>";
                echo "<title>Andes Coffee - Register new product</title>";
        
            } else if($config_type == "ChangeProduct") {
                echo "<link rel='stylesheet' href='_css/admin/change_product.css'>";
                echo "<title>Andes Coffee - Change Product</title>";

        
            } else if($config_type == "RegisterSupplier") {
                echo "<link rel='stylesheet' href='_css/admin/register_supplier.css'>";
                echo "<title>Andes Coffee - Register Supplier</title>";
            }
        ?> 

    </head>
    <body>
        <?php require_once("partials/index/header.php"); ?>

        <main>
            <div class="content">
            
                <?php
                    if($config_type == "RegisterNewProduct") {
                        require_once("partials/admin/form_register_new_product.php");
                
                    } else if($config_type == "ChangeProduct") {
                        require_once("partials/admin/form_change_product.php");
                
                    } else if($config_type == "RegisterSupplier") {
                        require_once("partials/admin/register_supplier.php");
                    }
                 ?> 
            </div>
        </main>        
        <?php require_once("partials/index/footer.php") ?>
        <script src="js/index/addToCart.js"></script>
        <script src="js/index/addToFavorite.js"></script>

        <?php if($config_type == "RegisterNewProduct" || isset($_GET['_change'])) { ?>
            <script src="js/admin/file_validation_upload.js"></script>
        <?php } else if($config_type == "ChangeProduct") { ?>
            <script>
                const products = document.querySelectorAll('.row');

                products.forEach(function(row, index) {
                    row.addEventListener('click', () => {
                        let id = row.firstElementChild.innerText;

                        window.location = `config.php?_configType=ChangeProduct&_change=${id}`;
                    })
                });
            </script>
        <?php } ?>

        <?php
            if(isset($success)) {
                if($config_type == "RegisterNewProduct") {
                    alertUser($success, "Registered successfully", "Failed to register product");
                } else if($config_type == "ChangeProduct") {
                    alertUser($success, "Product successfully changed", "Product change error");
                } else if($config_type == "RegisterSupplier") {
                    alertUser($success, "Registered successfully", "Error registering supplier");
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