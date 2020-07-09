<?php 
    
    require_once("../connect/connection.php");
    
    session_start();
    
    $products = "SELECT produtoID, nomeproduto, precounitario, imagempequena FROM produtos ";

    if(isset($_GET["search"])) {
        $product_name    = urlencode($_GET["search"]);
        $products       .= "WHERE nomeproduto LIKE '%{$product_name}%' "; 
    }
    $query = mysqli_query($connect, $products);
    
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
        <link rel="stylesheet" href="_css/products.css">
        <link rel="stylesheet" href="_css/login_style.css">
        <title>Andes Coffee</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <ul>
            <?php
                while($pr = mysqli_fetch_assoc($query)) {
            ?>
                <li>
                    <a href="product_details.php?product_Id=<?php echo $pr["produtoID"] ?>">
                        <img width="80" src="<?php echo $pr["imagempequena"] ?>" alt="imagem do produto">
                        <h3><?php echo $pr["nomeproduto"] ?></h3>
                        <span><?php echo "USD " . number_format($pr["precounitario"], 2,",",".") ?></span>
                    </a>
                    <a class="buy" href="purchase.php?product_Id=<?php echo $pr["produtoID"] ?>">
                        Purchase
                    </a>
                </li>                    
            <?php } ?>
            </ul>
        </main>        
        <?php require_once("partials/footer.php") ?>
    </body>
</html>

<?php mysqli_close($connect); ?>