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
            <div id="product-purchase">
                <?php //if(isset($nomeproduto)) { ?>
                    <table>
                        <caption>Purchase information</caption>

                        <?php
                            for($i = 0; $i < $arraysize; $i++) {

                                $product = "SELECT * FROM produtos WHERE produtoID = {$array[$i]}";

                                $query = mysqli_query($connect, $product);
                                $details = mysqli_fetch_assoc($query);
                            
                                $imagempequena  = $details['imagempequena'];
                                $nomeproduto    = $details['nomeproduto'];
                                $codigobarra    = $details['codigobarra'];
                                $estoque        = $details['estoque'];
                                $estoque        = $details['estoque'];
                                $precounitario  = $details['precounitario'];                            
                        ?>

                        <div id="product-details">
                            <tr>
                                <td rowspan="6">1</td>
                            </tr>
                            <tr>
                                <td rowspan="5">
                                    <img src="<?php echo $imagempequena ?>" alt="Imagem do produto">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php echo $nomeproduto ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php echo "Bar code: " . $codigobarra ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="600">
                                    <?php echo $estoque . " Available units"; ?>
                                </td>
                                <td class="inputs">Amount: 
                                    <input type="number" name="amount" value="1" min="1" max="<?php echo $estoque ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo "USD " . number_format($precounitario, 2,",",".") . " - Unit price" ?>
                                </td>
                                <td class="inputs" id="total">
                                    <?php echo "Total: USD " . number_format($precounitario, 2,",",".") ?>
                                </td>
                            </tr>
                        </div>

                        <?php } ?>

                    </table>

                <?php //} else { ?>
                    <h1 style="text-align:center">You do not have any products in the cart</h1>
                <?php// } ?>

            </div>
        </main>
        
        <?php require_once("partials/footer.php") ?>
    </body>
    <script>
        const inputAmount  = document.querySelector('input[name=amount]');
        const totalElement = document.querySelector('#total');

        inputAmount.addEventListener('change', () => {

        let precounitario = <?php echo $precounitario ?>;
        let estoque = <?php echo $estoque ?>;

        let mult = inputAmount.value;

        totalElement.innerHTML = "Total: USD ";

        if(inputAmount.value > estoque) {

            precounitario *= estoque;
            totalElement.innerHTML += precounitario.toFixed(2).replace(".",",");
            inputAmount.value = estoque;

        } else {

            precounitario *= mult;
            totalElement.innerHTML += precounitario.toFixed(2).replace(".",",");
        }
        });
    </script>
</html>

<?php mysqli_close($connect); ?>