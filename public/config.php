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
        <?php require_once("partials/index/head_global.php"); ?>
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
        <?php require_once("partials/index/window_alert.php"); ?>

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
        <script src="js/alert.js"></script>
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

        <script>
            let success     = parseInt(<?php if(isset($success)) {echo $success;} ?>);
            let deleted     = parseInt(<?php if(isset($deleted)) {echo $deleted;} ?>);
            let config_type = "<?php echo $config_type ?>"

            function isSuccess(_success, _error) {
                if(success == 1) {
                    windowAlert(_success);
                } else if(success == 0){
                    windowAlert(_error);
                }
            }

            if(config_type == "RegisterNewProduct") {
                isSuccess("Registered successfully", "Failed to register product");
                success == -1;
            } else if(config_type == "ChangeProduct") {
                isSuccess("Product successfully changed", "Product change error");
                success == -1;
            } else if(config_type == "RegisterSupplier") {
                isSuccess("Registered successfully", "Error registering supplier");
                success == -1;
            }
            
            if(deleted == 1) {
                windowAlert("Product successfully deleted")
                deleted = -1;
            } else if(deleted == 0) {
                windowAlert("It was not possible to delete the product")
                deleted = -1;
            }

        </script>

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