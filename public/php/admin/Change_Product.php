<?php 

    // Pesquisa de produtos
    if(isset($_GET['search'])) {
        $search_value = $_GET['search'];

        $bar_code = $search_value;

        $search  = "SELECT * FROM produtos ";

        if($search_value != null) {
            if(is_numeric($search_value) && $bar_code < 99999) {
                $search .= "WHERE produtoID = {$search_value} ";
                print_r("Pesquisa por código reduzido");
            } else if(!is_numeric($search_value)){
                $search .= "WHERE nomeproduto LIKE '%{$search_value}%' ";
                print_r("Pesquisa por nome");
            } else if($bar_code > 99999) {
                $search .= "WHERE codigobarra LIKE '%{$search_value}%' ";
                print_r("Pesquisa por código de barra");
            } 
        }

        $search_query = mysqli_query($connect, $search);

        while($search_result = mysqli_fetch_assoc($search_query)) {
            $produtoID[]     = $search_result['produtoID'];
            $nomeproduto[]   = $search_result['nomeproduto'];
            $descricao[]     = $search_result['descricao'];
            $codigobarra[]   = $search_result['codigobarra'];
            $precounitario[] = $search_result['precounitario'];
            $estoque[]       = $search_result['estoque'];
            $descontinuado[] = $search_result['descontinuado'];
            $fornecedorID[]  = $search_result['fornecedorID'];
            $categoriaID[]   = $search_result['categoriaID'];
        }

    } else if(isset($_POST['_produtoID'])) {
        // Alteração de produtos

        $success = 2;
        $_filesPath = [];            
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

        if($_FILES['upload']['size'][0] > 0) {
            $imagemgrande  = $_filesPath[0];
            $imagempequena = $_filesPath[1];
        } else {
            $imagemgrande  = $_POST['imagemgrande'];
            $imagempequena = $_POST['imagempequena'];
        }

        $produtoID     = $_POST['_produtoID'];
        $nomeproduto   = $_POST['_nomeproduto'];
        $descricao     = $_POST['_descricao'];
        $codigobarra   = $_POST['_codigobarra'];
        $precounitario = $_POST['_precounitario'];
        $estoque       = $_POST['_estoque'];
        $descontinuado = $_POST['_descontinuado'];
        $fornecedorID  = $_POST['_fornecedorID'];
        $categoriaID   = $_POST['_categoriaID'];

        $update  = "UPDATE produtos SET nomeproduto = '{$nomeproduto}', descricao = '{$descricao}', ";
        $update .= "codigobarra = '{$codigobarra}', precounitario = {$precounitario}, estoque = {$estoque}, ";
        $update .= "imagemgrande = '{$imagemgrande}', imagempequena = '{$imagempequena}', descontinuado = {$descontinuado}, ";
        $update .= "fornecedorID = {$fornecedorID}, categoriaID = {$categoriaID} WHERE produtoID = {$produtoID}";

        $update_query = mysqli_query($connect, $update); 

        if(!$update_query) {
            die("Unexpected operation error");   
        } else {
            $success = 1;
        }

        function alertUser($value, $suc, $error) {
            if($value == 1) { 
                echo "<script> alert('". $suc . "'); </script>";
            } else if($value == 0) {   
                echo "<script> alert('". $error . "'); </script>";
            } 
        }
    } else if(isset($_GET['_delete'])) {
        $ID     = $_GET['_id'];
        $delete = $_GET['_delete'];

        if($delete == 1) {
            $del = "DELETE FROM `produtos` WHERE `produtos`.`produtoID` = {$ID}";
            $result = mysqli_query($connect, $del);

            if(!$result) {
                die("Error");
            }
        }
    }

?>