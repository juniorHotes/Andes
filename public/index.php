<?php 
    
    require_once("../connect/connection.php");
    
    session_start();

    $products = "SELECT produtoID, nomeproduto, precounitario, imagempequena FROM produtos ";
    $p_ids = [];
    if(isset($_GET["search"])) {
        $product_name = urlencode($_GET["search"]);
        $products    .= "WHERE nomeproduto LIKE '%{$product_name}%' "; 
    } else if(isset($_GET["favorites"])) {
        $p_ids = $_GET["favorites"];
        
        if($p_ids) {
            $products  .= "WHERE produtoID IN ({$p_ids}) ";
        }
    }
    
    $query = mysqli_query($connect, $products);

    if(!$query) {
        die("Falha na consulta ao banco de dados");   
    }        
    
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("partials/index/head_global.php"); ?>
        <link rel="stylesheet" href="_css/index/products.css">
        <title>Andes Coffee</title>
    </head>
    
    <body>
        <?php require_once("partials/index/header.php"); ?>
        <?php require_once("partials/index/window_alert.php"); ?>
        
        <main>
            <div class="content">
                <ul>
                <?php
                    if($p_ids != 0) {
                        while($pr = mysqli_fetch_assoc($query))  {
                ?>
                    <li>
                        <a href="product_details.php?product_Id=<?php echo $pr["produtoID"] ?>">
                            <div class="product-content _hover">
                                <img width="80" src="<?php echo $pr["imagempequena"] ?>" alt="imagem do produto">
                                <h3><?php echo $pr["nomeproduto"] ?></h3>
                                <span><?php echo "USD " . number_format($pr["precounitario"], 2,",",".") ?></span>
                            </div>
                        </a> 
                        <button class="button-heart" value="<?php echo $pr["produtoID"] ?>" title="add favorite">
                        </button>
                        <button class="add-to-cart button-hover" value="<?php echo $pr["produtoID"] ?>" title="Add to cart">
                            Add to cart
                        </button> 
                    </li> 
                <?php 
                        } 
                    } else {
                ?>
                </ul>
                    <h1>You have not added any products to favorites</h1>
                <?php } ?>
            </div>
        </main>        
        <?php require_once("partials/index/footer.php") ?>
        <script src="js/alert.js"></script>
        <script src="js/index/addToCart.js"></script>
        <script src="js/index/addToFavorite.js"></script>
    </body>
</html>

<?php mysqli_close($connect); ?>