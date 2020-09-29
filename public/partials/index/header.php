<header>
    <div id="title"><a href="index.php"><h1>Andes Coffee</h1></a></div>
    
    <form action="index.php" method="get">
        <input type="search" name="search" placeholder="Search">
        <button></button>
    </form>

    <div class="links-content">
        <div id="favorite-content" class="container-links">
            <a href="index.php?favorites=">
                <img width="42px" src="assets/coracao-header.svg" alt="Favorites" title="Favorites">
                <p id="favorite-items" class="circle-qdt">0</p>
            </a>
        </div>

        <div id="cart-content" class="container-links">
            <a href="cart.php">
                <img width="42px" src="assets/carrinho.svg" alt="Cart" title="Cart">
                <p id="cart-items" class="circle-qdt">0</p>
            </a>
        </div>

        <div id="user-content" class="container-links">
            <?php if(isset($_SESSION["usuario"])) { ?> 
                <a href="logout.php">
                    <img width="42px" src="assets/user_icon.svg" alt="User" title="User">
                    <p>Logout</p>
                </a>
            <?php } else { ?>
                <a href="login.php">
                    <img width="42px" src="assets/user_icon.svg" alt="User" title="User">
                    <p>Logon</p>
                </a>
            <?php } ?>
        </div>
        
        <?php 
            if(isset($_SESSION['nivel'])) {
                $is_admin = $_SESSION['nivel'];
                if($is_admin == 'admin') {
        ?>
        <div id="config-content" class="container-links">
            <a href="admin.php">
                <img width="42px" src="assets/configuracoes.svg" alt="Configurations" title="Configurations">
            </a>
        </div>
        <?php 
                }
            }    
        ?>
    </div>
</header>
