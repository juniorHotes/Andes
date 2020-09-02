<h2>Change Product</h2>
<p><span>*</span>All fields are mandatory</p>
<?php 
    if(!isset($_GET['_change'])) { 
        require_once('search_product.php');
    } else { 
        require_once('change_product.php');
    }
?> 
