 <?php
    // Alteração de produto

    $id_product = $_GET['_change'];

    $product = "SELECT * FROM produtos WHERE produtoID = {$id_product}";
    $product_query = mysqli_query($connect, $product);
    $product_result = mysqli_fetch_assoc($product_query);

    $providers = "SELECT * FROM fornecedores ";
    $providers_query = mysqli_query($connect, $providers);
    
    $category = "SELECT * FROM categorias ";
    $category_query = mysqli_query($connect, $category);


    function imageName($str, $img_directory) {
        $str_length = strlen($img_directory);
        $str_pos = strrpos($img_directory, "/");

        $name_image = $str . substr($img_directory, $str_pos +1, $str_length);
        
        return $name_image;
    }
?>
<form action="config.php?_configType=ChangeProduct" method="POST" enctype="multipart/form-data">
    <div id="form-content">
        <div class="inputs-content">
            <input type="hidden" name="_produtoID" value="<?php echo $product_result['produtoID'] ?>">

            <label for="_nomeproduto"><span>*</span>Name</label>
            <input type="text" name="_nomeproduto" value="<?php echo $product_result['nomeproduto'] ?>" placeholder="Product name" required autofocus>

            <label for="_descricao"><span>*</span>Description</label>
            <textarea name="_descricao" required style="resize:vertical; height:50px">
                <?php echo $product_result['descricao'] ?>
            </textarea>

            <label for="_codigobarra"><span>*</span>Bar code</label>
            <input type="number" value="<?php echo $product_result['codigobarra'] ?>" min="0" max="9999999999999" name="_codigobarra" placeholder="Exe: 123456789" required>

            <label for="_precounitario"><span>*</span>Value</label>
            <input type="number" min="0" value="<?php echo $product_result['precounitario'] ?>" step="any" name="_precounitario" placeholder="Exe: 12.99" required>
                
            <label for="_estoque"><span>*</span>Stock</label>
            <input type="number" value="<?php echo $product_result['estoque'] ?>" min="0" name="_estoque" placeholder="Quantity of products in stock" required>

            <label for="_descontinuado"><span>*</span>Discontinued</label>
            <input type="number" value="<?php echo $product_result['descontinuado'] ?>" min="0" name="_descontinuado" required>

            <label for="_fornecedorID"><span>*</span>Supplier</label>
            <select name="_fornecedorID" id="_supplier_id">
                <option value="0">Select supplier</option>

                <?php while ($providers_result = mysqli_fetch_assoc($providers_query)) { ?>
                    <option 
                        <?php 
                            if($product_result['fornecedorID'] == $providers_result['fornecedorID']) {
                                echo "selected";
                            }
                        ?>
                        value="<?php echo $providers_result['fornecedorID'] ?>">
                        <?php echo $providers_result['nomefornecedor'] ?>
                    </option>
                <?php } ?>
                
            </select>

            <label for="_categoriaID"><span>*</span>Category</label>
            <select name="_categoriaID" id="_category_id">
                <option value="0">Select category</option>

                <?php while ($category_result = mysqli_fetch_assoc($category_query)) {?>
                    <option 
                        <?php 
                            if($product_result['categoriaID'] == $category_result['categoriaID']) {
                                echo "selected";
                            }
                        ?>
                        value="<?php echo $category_result['categoriaID'] ?>">
                        <?php echo $category_result['nomecategoria'] ?></option>
                <?php } ?>
                
            </select>
        </div> 

        <div class="inputs-content">
            <label class="up-label" for="'_files-images'"><span>*</span>Select the product images</label>
            <input type="file" name="upload[]" id="'_files-images'" accept="image/*" hidden="hidden" multiple="multiple">
            
            <div class="image-preview" id="preview1">
                <img src="<?php echo $product_result['imagemgrande'] ?>" alt="Image Preview" id="imagePreview1" class="image-preview__image">
                <input type="hidden" name="imagemgrande" value="<?php echo $product_result['imagemgrande'] ?>">
                <span class="image-preview__default-text">
                    <!-- Large image preview <br> <strong>less than 500 KB dimensions 255x255</strong>  -->
                </span>
            </div>
            <h5 class="img-name">
                <?php 
                    echo imageName("Small image ", $product_result['imagemgrande']);
                ?>
            </h5>

            <div class="image-preview" id="preview2">
                <img src="<?php echo $product_result['imagempequena'] ?>" alt="Image Preview" id="imagePreview2" class="image-preview__image">
                <input type="hidden" name="imagempequena" value="<?php echo $product_result['imagempequena'] ?>">
                <span class="image-preview__default-text">
                    <!-- Small image preview <br> <strong>less than 500 KB dimensions 69x69</strong>    -->
                </span>
            </div> 
            <h5 class="img-name">
                <?php 
                    echo imageName("Large image ", $product_result['imagempequena']);
                ?>
            </h5>
        </div>
    </div>
    <input type="submit" value="Register" class="_hover">
    
    <a 
        id="delete" 
        class="_hover" 
        href="config.php?_configType=ChangeProduct&_id=<?php echo $product_result['produtoID'] ?>&_delete=1">
        Delete
    </a> 
</form>