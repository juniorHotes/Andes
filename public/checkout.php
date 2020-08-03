<?php 
    
    require_once("../connect/connection.php");

    session_start();

    $use = false;

    if(isset($_SESSION["usuario"])) {
        $user = true;
    } else {
        $user = false;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="_css/index.css">
        <link rel="stylesheet" href="_css/checkout.css">
        <title>Andes - Checkout</title>
    </head>
    <body>
        <?php require_once("partials/header.php"); ?>

        <main>
            <?php if($user == false) { 
                
                header("location:login.php?Checkout")
            ?>
            <?php } else { ?>

                <div id="credit-card">
                    <h2>Form of payment</h2>
                    <form action="#">
                        <div class="form-payment">
                            <div>
                                <input type="radio" name="credit-card" value="credit-card" checked>
                                <label for="credit-card">Credit card</label>
                            </div>
                            <div>
                                <input type="radio" name="billet" value="">
                                <label for="billet">Billet</label>
                            </div>
                        </div>
            
                        <div class="flags">
                            <div class="flags-title">Credit cards</div>
                            <div class="line">
                                <img src="assets/visa.svg" width="48" alt="Visa" title="Visa">
                                <img src="assets/mastercard.svg" width="48" alt="Mastercard" title="Mastercard">
                                <img src="assets/DinersClub.png" width="48" alt="Dinners" title="Dinners">
                                <img src="assets/elo.png" width="48" alt="Elo" title="Elo">
                            </div>
                        </div>

                        <label for="card-number">Card number</label>
                        <input type="text" name="card-number" value="" placeholder="Ex: 0123456789" autofocus>

                        <label for="security-code">Security code</label>
                        <input type="text" name="security-code" value="" placeholder="Ex: 123">

                        <label for="expiration-date">Expiration date</label>
                        <input type="month" name="expiration-date" value="">

                        <label for="installments">Number of installments</label>
                        <select name="installments" id="installments">
                            <option value="1">1x Interest-free</option>
                            <option value="2">2x Interest-free</option>
                            <option value="3">3x Interest-free</option>
                            <option value="4">4x Interest-free</option>
                            <option value="5">5x Interest-free</option>
                            <option value="6">6x Interest-free</option>
                            <option value="7">7x Interest-free</option>
                            <option value="8">8x Interest-free</option>
                            <option value="9">9x Interest-free</option>
                            <option value="10">10x Interest-free</option>
                        </select>
                        <input type="submit" value="Submit">
                    </form> 
                </div>
            <?php } ?>        
        </main>

        <?php require_once("partials/footer.php") ?>
    </body>
    <script src="js/addToCart.js"></script>
</html>

<?php mysqli_close($connect); ?>