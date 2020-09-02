<?php 
    
    require_once("../connect/connection.php");
    
    session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index/index.css">
        <title>Andes Coffee - Config</title>
    </head>
    <style>
        main {
            max-width: 1150px;
            min-height: 100vh;
            margin: 0 auto;
        }
        main ul {
            display: grid;
            list-style: none;
            grid-template-columns: 1fr 1fr 1fr; 
            margin-top: 100px;   
        }
        main ul li {
            position: relative;
        }
        main ul li a .content {
            width: 360px;
            height: 110px;
            margin: 6px; 
            padding: 10px 20px;
            background-color: var(--color-button-green);
        }
        main ul li a {
            text-decoration: none;
        }
        main ul li h2 {
            margin: 8px 0;
            line-height: 18px;
            color: var(--color-text-black);
            text-align: center;
            line-height: 70px;
            color: white;
        }
    </style>
    <body>
        <?php require_once("partials/index/header.php"); ?>

        <main>
            <ul>
                <li>
                    <a href="config.php?_configType=RegisterNewProduct">
                        <div class="content _hover">
                            <h2>Register new product</h2>
                        </div>
                    </a> 
                </li> 
                <li>
                    <a href="config.php?_configType=ChangeProduct">
                        <div class="content _hover">
                            <h2>Change product</h2>
                        </div>
                    </a> 
                </li> 
                <li>
                    <a href="config.php?_configType=RegisterSupplier">
                        <div class="content _hover">
                            <h2>Register supplier</h2>
                        </div>
                    </a> 
                </li> 
            </ul>
        </main>        
        <?php require_once("partials/index/footer.php") ?>
        <script src="js/index/addToCart.js"></script>
        <script src="js/index/addToFavorite.js"></script>
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