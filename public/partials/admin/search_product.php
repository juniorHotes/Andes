<!-- Pesquisar produtos -->
<form action="config.php" method="get">
    <input type="hidden" name="_configType" value="ChangeProduct">
    <label for="search">Search product</label>
    <div class="search-container">
        <input type="search" name="search" placeholder="Id, bar code or name">
        <button></button>
    </div>
</form>
<div id="table-container">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Bar code</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Discontinued</th>
            <th>Provider</th>
            <th>Category</th>
        </tr>
        <?php 
            if(isset($_GET['search'])) {

                if($search_query->num_rows > 0) {                    
                    for ($i = 0; $i < count($produtoID); $i++) {
        ?>
            <tr class="row">
                <td>
                    <?php echo $produtoID[$i]  ?>
                </td>
                <td>
                    <?php echo $nomeproduto[$i] ?>
                </td>
                <td title="<?php echo $descricao[$i] ?>">
                    <?php echo $descricao[$i] ?>
                </td>
                <td>
                    <?php echo $codigobarra[$i] ?>
                </td>
                <td>
                    <?php echo $precounitario[$i] ?>
                </td>
                <td>
                    <?php echo $estoque[$i] ?>
                </td>
                <td>
                    <?php echo $descontinuado[$i] ?>
                </td>
                <td>
                    <?php 
                        echo $fornecedorID[$i] ."-"; 

                        $providers = "SELECT * FROM fornecedores WHERE fornecedorID = {$fornecedorID[$i]} ";
                        $providers_query = mysqli_query($connect, $providers);
                        $providers_result = mysqli_fetch_assoc($providers_query);

                        echo $providers_result['nomefornecedor'];
                    ?>
                </td>
                <td>
                    <?php 
                        echo $categoriaID[$i] ."-";
                        
                        $category = "SELECT * FROM categorias WHERE categoriaID = {$categoriaID[$i]} ";
                        $category_query = mysqli_query($connect, $category);
                        $category_result = mysqli_fetch_assoc($category_query);

                        echo $category_result['nomecategoria'];
                    ?>
                </td>
            </tr>
        <?php 
                    }
                } else if($search_query->num_rows == 0) { 
                    echo "<h1 style='text-align:center;color:red'>Product not found</h1>";
                } 
            }
        ?>
    </table>
</div>
