<h2>Register new product</h2>

<form action="config.php?_configType=RegisterNewProduct" method="POST" enctype="multipart/form-data">
    <div id="form-content">
        <div class="inputs-content">
            <label for="_nomeproduto">Name <span>*</span></label>
            <input type="text" name="_nomeproduto" placeholder="Product name" required autofocus>

            <label for="_descricao">Description <span>*</span></label>
            <textarea name="_descricao" required style="resize:vertical; height:50px">
            </textarea>

            <label for="_codigobarra">Bar code <span>*</span></label>
            <input type="number" min="0" max="13" name="_codigobarra" placeholder="Exe: 123456789" required>

            <label for="_precounitario">Value <span>*</span></label>
            <input type="number" min="0" step="any" name="_precounitario" placeholder="Exe: 12.99" required>
                
            <label for="_estoque">Stock <span>*</span></label>
            <input type="number" min="0" name="_estoque" placeholder="Quantity of products in stock" required>

            <label for="_fornecedorID">Supplier <span>*</span></label>
            <select name="_fornecedorID" id="_supplier_id">
                <option value="0">Select supplier</option>

                <?php while ($supplier = mysqli_fetch_assoc($supplier_query)) {?>
                    <option value="<?php echo $supplier['fornecedorID'] ?>"><?php echo $supplier['nomefornecedor'] ?></option>
                <?php } ?>
                
            </select>

            <label for="_categoriaID">Category <span>*</span></label>
            <select name="_categoriaID" id="_category_id">
                <option value="0">Select category</option>

                <?php while ($category = mysqli_fetch_assoc($category_query)) {?>
                    <option value="<?php echo $category['categoriaID'] ?>"><?php echo $category['nomecategoria'] ?></option>
                <?php } ?>

            </select>
        </div> 


        <div class="inputs-content">
            <label class="up-label" for="'_files-images'">Select the product images <span>*</span></label>
            <input type="file" name="upload[]" id="'_files-images'" accept="image/*" hidden="hidden" multiple="multiple">
            
            <div class="image-preview" id="preview1">
                <img src="" alt="Image Preview" id="imagePreview1" class="image-preview__image">
                <span class="image-preview__default-text">
                    Large image preview <br> <strong>less than 500 KB dimensions 255x255</strong> 
                </span>
            </div>
            <h5 class="img-name"></h5>

            <div class="image-preview" id="preview2">
                <img src="" alt="Image Preview" id="imagePreview2" class="image-preview__image">
                <span class="image-preview__default-text">
                    Small image preview <br> <strong>less than 500 KB dimensions 69x69</strong>   
                </span>
            </div> 
            <h5 class="img-name"></h5>
        </div> 
    </div>
    <input type="submit" value="Register" class="_hover">

</form>
