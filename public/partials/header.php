<header>
    <a href="index.php"><h1>Andes Coffee</h1></a>

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

    <form action="index.php" method="get">
        <input type="search" name="search" placeholder="Search">
        <button></button>
    </form>

</header>
