<?php 
    require_once("../connect/connection.php");

    session_start();

    $user_create = false;
    $users;
    
    if(isset($_POST["nomecompleto"])){
        $nomecompleto = $_POST["nomecompleto"];
        $endereco     = $_POST["endereco"];   
        $complemento  = $_POST["complemento"];
        $numero       = $_POST["numero"];
        $estado       = $_POST["state"];
        $cidade       = $_POST["city"];
        $cep          = $_POST["cep"];
        $ddd          = $_POST["ddd"];
        $telefone     = $_POST["telefone"];
        $email        = $_POST["email"];
        $usuario      = $_POST["usuario"];  
        $senha        = $_POST["senha1"];   

        $insert  = "INSERT INTO clientes ";
        $insert .= "(nomecompleto, endereco, complemento, numero, estado, cidade, cep, ddd, telefone, email, usuario, senha) ";
        $insert .= "VALUES ";
        $insert .= "('$nomecompleto','$endereco','$complemento','$numero','$estado','$cidade','$cep','$ddd','$telefone','$email','$usuario','$senha')";
        
        $acesso = mysqli_query($connect, $insert);
        if(!$acesso){
            die("Falha ao consultar banco de dados.");
        }

        $user_create = true;
    }   
    
    $select_users = "SELECT usuario FROM clientes ";

    $query = mysqli_query($connect, $select_users);
    
    while($user = mysqli_fetch_assoc($query)) {          
        $users[] = $user['usuario'];
    }   

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index.css">
        <link rel="stylesheet" href="_css/login_style.css">
        <title>Andes Coffee - Sign up</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <div class="login-content show-login">
                <div class="login-window">
                    <form action="sign_up.php" method="POST">
                        <h2>Create your user</h2>
                        <input type="text" autocomplet name="nomecompleto" placeholder="Full name" required autofocus>
                        <input type="text" name="endereco" placeholder="Adress" required>
                        <input type="text" name="complemento" placeholder="Complement">
                        <input type="text" name="numero" placeholder="Number" required>

                        <select id="estado" required>
                            <option value>State</option>
                        </select>

                        <select id="cidade" disabled="disabled" required>
                        </select>

                        <input type="text" name="cep" placeholder="CEP" required>
                        <input type="tel" maxlength="14" placeholder="Phone" name="telefone" required>
                        <input type="email" name="email" placeholder="Email exe: youremail@mail.com" required>
                        <input type="text" name="usuario" placeholder="User name" required>
                        <input type="password" name="senha1" placeholder="Password (minimum 8 characters)" required>
                        <input type="password" name="senha2" placeholder="Repeat the password" required>
                        <input type="submit" value="Save">

                        <input type="hidden" name="ddd"     value="">
                        <input type="hidden" name="state"   value="">
                        <input type="hidden" name="city"    value="">
                    </form>
                </div>
            </div>

            <div id="successful">
                <h1>User created successfully</h1>
            </div>
        </main>
                
        <?php require_once("partials/footer.php") ?>
    </body>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/signup_validation.js"></script>
    <script src="js/addToCart.js"></script>
    <script type="text/javascript">
        const userNameInput = document.querySelector('input[name=usuario]')        
        let varr = <?php echo json_encode($users) ?>;

        userNameInput.addEventListener('blur', (event) => {

            let nome = varr[varr.indexOf(event.target.value)];
            
            if(event.target.value == nome) {
                alert('Existing user, please choose another name');
            }
        });

        if("<?php echo $user_create ?>" == true) {
            setTimeout(() => {
                window.location = "login.php"
            }, 2000);
        }
    </script>
</html>
<?php mysqli_close($connect); ?>