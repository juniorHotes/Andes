<?php 

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

    // Categoria
    $categoryID = $details['categoriaID'];

    $category = "SELECT * FROM categorias WHERE categoriaID = {$categoryID}";

    $query_category = mysqli_query($connect, $category);
    $_category = mysqli_fetch_assoc($query_category);

    if(!$query) {
        die("Falha na consulta ao banco de dados");
    }
    
?>