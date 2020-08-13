<?php 
    
    require_once("../connect/connection.php");

    session_start();

    if(isset($_GET['product_Id'])) {
        $productID = $_GET['product_Id'];
    } else {
        Header('location: index.php');
    }
    
    $product = "SELECT * FROM produtos WHERE produtoID = {$productID}";

    $query = mysqli_query($connect, $product);
    $details = mysqli_fetch_assoc($query);

    if(!$query) {
        die("Falha na consulta ao banco de dados");
    }
    
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index.css">
        <link rel="stylesheet" href="_css/product_details.css">
        <title>Andes - Product details</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <div id="product-details">
                <ul>
                    <img src="<?php echo $details['imagemgrande']; ?>" alt="Imagem do produto">
                    <div id="details">
                        <h2><?php echo $details['nomeproduto']; ?></h2>
                        <h4><?php echo $details['descricao']; ?></h4>
                        <p><?php echo $details['estoque'] . " Available units"; ?></p>
                        <span><?php echo "USD " . number_format($details['precounitario'], 2,",",".") ?></span>
                    </div>
                    <button class="add-to-cart button-hover" value="<?php echo $details["produtoID"] ?>" title="Add to cart">
                        Add to cart
                    </button> 
                </ul>
            </div>
        </main>
        
        <?php require_once("partials/footer.php") ?>
        <script src="js/addToCart.js"></script>
        <script>
            const favoriteItems = document.querySelector('#favorite-items')
            let fItems = JSON.parse(localStorage.getItem("favorites"))
            favoriteItems.innerHTML = fItems.length;
        </script>
    </body>
</html>

<?php mysqli_close($connect); ?>