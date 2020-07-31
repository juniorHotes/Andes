<?php 
    
    require_once("../connect/connection.php");

    session_start();
    
    require_once("php/purchase_infor.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index.css">
        <link rel="stylesheet" href="_css/cart.css">
        <title>Andes - you cart</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <?php if(isset($_COOKIE[$cookie_name])) { ?>

                <h1>Your cart</h1>

                <?php
                    for($i = 0; $i < $arraysize; $i++) {

                        $product = "SELECT * FROM produtos WHERE produtoID = {$array[$i]}";
            
                        $query = mysqli_query($connect, $product);
                        $details = mysqli_fetch_assoc($query);
                        
                        $produtoID      = $details['produtoID'];
                        $imagempequena  = $details['imagempequena'];
                        $nomeproduto    = $details['nomeproduto'];
                        $codigobarra    = $details['codigobarra'];
                        $estoque        = $details['estoque'];
                        $precounitario  = $details['precounitario'];                            
                    
                ?>

                <div class="product-details">
                    <div>
                        <img src="<?php echo $imagempequena ?>" alt="Imagem do produto">
                    </div>
                    <div class="details" >
                        <div>
                            <h2><?php echo $nomeproduto ?></h2>
                            <h5><?php echo $estoque . " Available units"; ?></h5>
                            <h4><?php echo "$" . number_format($precounitario, 2,",",".") . " - Unit price" ?></h4>
                        </div>
                        <div class="inputs">                        
                            <p id="total">
                                <?php echo "Total: $" . number_format($precounitario, 2,",",".") ?>
                            </p>
                            <div>
                                <label for="amount">Units</label>
                                <input id="<?php echo $i ?>" type="number" name="amount" value="1" min="1" max="<?php echo $estoque ?>">
                            </div>
                            <div class="delete" id="<?php echo $i ?>">
                                <a href="#">
                                    <img width="24" src="assets/cruz.svg" alt="Delete item" title="Delete item">
                                </a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $precounitario ?>">
                </div>
                
                <?php } ?>
                
                <h2 id="total-value">
                    <?php echo "Total value of your cart: $" . number_format($precounitario, 2,",",".") ?>
                </h2>
                <div id="checkout">
                    <a href="checkout.php">Checkout</a>
                </div>

            <?php } else { ?>
                <h1 style="text-align:center">Your shopping cart is empty</h1>
            <?php } ?>

        </main>
        <?php require_once("partials/footer.php") ?>
    </body>
    <script src="js/cart.js"></script>
    <script src="js/addToCart.js"></script>
</html>

<?php mysqli_close($connect); ?>