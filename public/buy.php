<?php 
    
    require_once("../connect/connection.php");

    if(isset($_GET['product_Id'])) {
        $productID = $_GET['product_Id'];
    } else {
        Header('location: index.php');
    }
    // Produto
    $product = "SELECT * FROM produtos WHERE produtoID = {$productID}";

    $query = mysqli_query($connect, $product);

    $details = mysqli_fetch_assoc($query);

    // Fornecedor
    $providerID = $details['fornecedorID'];
    $provider = "SELECT * FROM fornecedores WHERE fornecedorID = {$providerID}";

    $query_provider = mysqli_query($connect, $provider);

    $_provider = mysqli_fetch_assoc($query_provider);
    
    //
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
        <link rel="stylesheet" href="_css/purchase.css">
        <title>Andes - Finalizar compra</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <div id="product-purchase">
                <img src="<?php echo $details['imagemgrande']; ?>" alt="Imagem do produto">
                <div id="product-details">
                    <ul>
                        <li><?php echo $details['nomeproduto']; ?></li>
                        <li><?php echo "Bar code: " . $details['codigobarra']; ?></li>
                        <li><?php echo $details['descricao']; ?></li>
                        <li><?php echo $details['estoque'] . " Available units"; ?></li>
                        <li><?php echo "R$ " . number_format($details['precounitario'], 2,",",".") . " - Unit price" ?></li>
                    </ul>
                </div>
            </div>
            <div id="provider-details">
                    <table>
                        <caption>Supplier information</caption>
                        <tr>
                            <th>Provider ID</th>
                            <th>Provider</th>
                            <th>Address</th>
                            <th>City</th>
                        </tr>
                        <tr>
                            <td><?php echo $_provider['fornecedorID'] ?></td>
                            <td><?php echo $_provider['nomefornecedor'] ?></td>
                            <td><?php echo $_provider['endereco'] ?></td>
                            <td><?php echo $_provider['cidade'] ?></td>
                        </tr>
                    </table>
                </div>

        </main>
        
        <?php require_once("partials/footer.php") ?>
    </body>
</html>

<?php mysqli_close($connect); ?>