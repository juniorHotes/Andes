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
        <link rel="stylesheet" href="_css/purchase.css">
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
                            <h4><?php echo $estoque . " Available units"; ?></h4>
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
                    <input type="hidden" value="<?php echo $produtoID ?>">
                </div>

                <?php } ?>

            <?php } else { ?>
                <h1 style="text-align:center">Your shopping cart is empty</h1>
            <?php } ?>

        </main>
        
        <?php require_once("partials/footer.php") ?>
    </body>
    <script>
        const inputAmount  = document.querySelectorAll('input[name=amount]')
        const totalElement = document.querySelector('#total')

        const productElement = document.querySelectorAll('input[type=hidden]')
        let id = []
        productElement.forEach((e) => {
            
            id.push(e.value)
            console.log(id)
        })

        inputAmount.forEach((input) => {
            input.addEventListener('change', () => {

            let precounitario = <?php echo $precounitario ?>;
            let estoque = <?php echo $estoque ?>;

            let mult = inputAmount.value

            totalElement.innerHTML = "Total: USD "

            if(inputAmount.value > estoque) {

                precounitario *= estoque;
                totalElement.innerHTML += precounitario.toFixed(2).replace(".",",")
                inputAmount.value = estoque;

            } else {

                precounitario *= mult;
                totalElement.innerHTML += precounitario.toFixed(2).replace(".",",")
            }
            });
        });

    </script>
    <script src="js/add_to_cart.js"></script>
</html>

<?php mysqli_close($connect); ?>