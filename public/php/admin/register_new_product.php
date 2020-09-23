<?php
    $success = -1;
    $_filesPath = [];
    if(isset($_POST['_nomeproduto'])) {
        
        if(count($_FILES['upload']['name']) > 0) {

            for($i = 0; $i < count($_FILES['upload']['name']); $i++) {

                $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                if($tmpFilePath != "") {
                    $shortname = $_FILES['upload']['name'][$i];

                    $filePath = "images/product_images/" . date('d-m-Y-H-i-s').'-'.$_FILES['upload']['name'][$i];
                    $_filesPath[] = $filePath;

                    if(move_uploaded_file($tmpFilePath, $filePath)) {
                        $success = 1;
                    }
                } else {
                    $success = 0;
                }
            }
        }   
    }

    $select_supplier = "SELECT fornecedorID, nomefornecedor FROM fornecedores";
    $supplier_query = mysqli_query($connect, $select_supplier);

    $select_category = "SELECT * FROM categorias";
    $category_query = mysqli_query($connect, $select_category);

    if($success == 1) {

        $nomeproduto    = $_POST['_nomeproduto'];
        $descricao      = $_POST['_descricao'];
        $codigobarra    = $_POST['_codigobarra'];
        $precounitario  = $_POST['_precounitario'];
        $estoque        = $_POST['_estoque'];
        $imagemgrande   = $_filesPath[0];
        $imagempequena  = $_filesPath[1];
        $fornecedorID   = $_POST['_fornecedorID'];
        $categoriaID    = $_POST['_categoriaID'];

        $insert_product  = "INSERT INTO `produtos`(`nomeproduto`, `descricao`, `codigobarra`, `precounitario`, `estoque`, `imagemgrande`, `imagempequena`, `fornecedorID`, `categoriaID`) "; 
        $insert_product .= "VALUES ('{$nomeproduto}','{$descricao}',{$codigobarra},{$precounitario},{$estoque},'{$imagemgrande}','{$imagempequena}',{$fornecedorID},{$categoriaID})";
        $category_query = mysqli_query($connect, $insert_product);

        if(!$category_query) {
            $success = 0;
            die("Unexpected operation error");   
        } else {
            $success = 1;
        }
    }
?>
