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
        <title>Andes - Checkout</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <?php if($arraysize >= 0) { ?>

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
                            <h4><?php echo "USD " . number_format($precounitario, 2,",",".") . " - Unit price" ?></h4>
                        </div>
                        <div class="inputs">                        
                            <p id="total">
                                <?php echo "Total: USD " . number_format($precounitario, 2,",",".") ?>
                            </p>
                            <div>
                                <label for="amount">Units</label>
                                <input type="number" name="amount" value="1" min="1" max="<?php echo $estoque ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $precounitario ?>">
                </div>
                
                <?php } ?>
                
                <h2 id="total-value" style="text-align: center">
                    <?php echo "Total value of your cart: USD " . number_format($precounitario, 2,",",".") ?>
                </h2>

            <?php } else { ?>
                <h1 style="text-align:center">Your shopping cart is empty</h1>
            <?php } ?>

        </main>
        
        <?php require_once("partials/footer.php") ?>
    </body>
    <script>
        const inputAmount  = document.querySelectorAll('input[name=amount]')
        const totalElement = document.querySelectorAll('#total')
        const productElement = document.querySelectorAll('input[type=hidden]')
        
        inputAmount.forEach((input) => {
            input.addEventListener('change', () => {
            
            console.log(inputAmount)
            let units = input.value
            console.log("units: "+ units)

            totalElement[0].innerHTML = "Total: USD "

            let estoque = input.max
            console.log("estoque: "+ estoque)
            
            let precounitario = productElement[0].value
            console.log("precounitario: "+ precounitario)

            if(units > estoque) {

                precounitario *= estoque;
                totalElement[0].innerHTML += precounitario.toFixed(2).replace(".",",")
                input.value = estoque;
                console.log("Igual ao estoque")

            } else {

                precounitario *= units;
                totalElement[0].innerHTML += precounitario.toFixed(2).replace(".",",")
                console.log("menor q o estoque")
            }
            });
        });

    </script>
    <script src="js/addToCart.js"></script>
</html>

<?php mysqli_close($connect); ?>