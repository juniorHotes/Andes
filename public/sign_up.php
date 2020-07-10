<?php 
    require_once("../connect/connection.php");

    session_start();

    if(isset($_POST["nomecompleto"])){
        $nomecompleto = $_POST["nomecompleto"];
        $endereco     = $_POST["endereco"];   
        $complemento  = $_POST["complemento"];
        $numero       = $_POST["numero"];
        $cidade       = $_POST["cidade"];
        $cep          = $_POST["cep"];
        $ddd          = $_POST["ddd"];
        $telefone     = $_POST["telefone"];
        $email        = $_POST["email"];
        $usuario      = $_POST["usuario"];  
        $senha        = $_POST["senha1"];   

        $insert  = "INSERT INTO clientes ";
        $insert .= "(nomecompleto, endereco, complemento, numero, cidade, cep, ddd, telefone, email, usuario, senha) ";
        $insert .= "VALUES ";
        $insert .= "('$nomecompleto','$endereco','$complemento','$numero','$cidade','$cep','$ddd','$telefone','$email','$usuario','$senha')";
        
        $acesso = mysqli_query($connect, $insert);
        if(!$acesso){
            die("Falha ao consultar banco de dados.");
        }
    }
        // $informacao = mysqli_fetch_assoc($acesso);
        
        // if(empty($informacao)){
        //     $mensagem = "Usuário ou senha invalido";
        // } else {
        //     $_SESSION["usuario"] = $informacao["clienteID"];
        //     header("location:index.php");
        // }
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
                        <input type="text" name="nomecompleto" placeholder="Full name" required>
                        <input type="text" name="endereco" placeholder="Adress" required>
                        <input type="text" name="complemento" placeholder="Complement">
                        <input type="text" name="numero" placeholder="Number" required>
                        <input type="text" name="cidade" placeholder="Cidade" required>
                        <input type="text" name="cep" placeholder="CEP" required>
                        <input type="text" name="ddd" placeholder="DDD" required>
                        <input type="tel" name="telefone" placeholder="Phone" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="text" name="usuario" placeholder="User name" required>
                        <input type="password" name="senha1" placeholder="Password (minimum 8 characters)" required>
                        <input type="password" name="senha2" placeholder="Repeat the password" required>
                        <input type="submit" value="Save">
                    </form>
                </div>
            </div>
        </main>
                
        <?php require_once("partials/footer.php") ?>
    </body>
    <script src="js/sign_up.js"></script>
    <script>

        // const estadoElement = document.querySelector('#estado');
        // const cidadeElement = document.querySelector('#cidade');
        // let cidadeID;

        // function solicitarEstados() {
            
        //     var xhttp = new XMLHttpRequest();

        //     xhttp.onreadystatechange = function() {

        //     if (this.readyState == 4 && this.status == 200) {
        //         let estados = JSON.parse(this.responseText);

        //         estados.forEach(estado => {
        //             estadoElement.innerHTML += `<option value="${estado.id}">${estado.nome}</option>`;
        //             //console.log(cidadeID);
        //         })   
        //     }
        //     };
        //     xhttp.open("GET", "https://servicodados.ibge.gov.br/api/v1/localidades/estados", true);
        //     xhttp.send();
        // }

        // solicitarEstados();
    </script>
</html>
<?php mysqli_close($connect); ?>