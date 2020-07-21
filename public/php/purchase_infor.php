<?php 

    if(isset($_GET['product_Id'])) {
        $productID = $_GET['product_Id'];

        $product = "SELECT * FROM produtos WHERE produtoID = {$productID}";

        $query = mysqli_query($connect, $product);
        $details = mysqli_fetch_assoc($query);
    
        $imagempequena  = $details['imagempequena'];
        $nomeproduto    = $details['nomeproduto'];
        $codigobarra    = $details['codigobarra'];
        $estoque        = $details['estoque'];
        $estoque        = $details['estoque'];
        $precounitario  = $details['precounitario'];

        if(!$query) {
            die("Falha na consulta ao banco de dados");
        }       
    }     
?>