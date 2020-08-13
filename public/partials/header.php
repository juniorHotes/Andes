<header>
    <a href="index.php"><h1>Andes Coffee</h1></a>
    
    <form action="index.php" method="get">
        <input type="search" name="search" placeholder="Search">
        <button></button>
    </form>

    <?php 
        // Mensagem de saudação para o usuario
        if(isset($_SESSION["usuario"])){
            $user = $_SESSION["usuario"];

            $access = "SELECT nomecompleto ";
            $access .= "FROM clientes ";
            $access .= "WHERE clienteID = {$user} ";
            
            $access_logon = mysqli_query($connect, $access);
            if(!$access_logon){
                die("Falha na consulta ao banco de dados");
            }

            $access_logon = mysqli_fetch_assoc($access_logon);
            $name = $access_logon["nomecompleto"];
    ?>
        <p><?php echo "Olá " . $name ?> - <a href="logout.php">Logout</a></p>
    <?php } else { ?>
        <a href="login.php">Logon</a>
    <?php } ?>

    <div class="favorite-cart-content">
        <div id="favorite-content">
            <a href="">
                <img width="42px" src="assets/coracao-header.svg" alt="Favorites" title="Favorites">
                <p id="favorite-items" class="circle-qdt">0</p>
            </a>
        </div>

        <div id="cart-content">
            <a href="cart.php">
                <img width="42px" src="assets/carrinho.svg" alt="Cart" title="Cart">
                <p id="cart-items" class="circle-qdt">0</p>
            </a>
        </div>
    </div>
</header>
