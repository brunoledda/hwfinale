<?php
if(isset($_POST["contr_user"])){
    $check = false;
    $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
    $user = mysqli_real_escape_string($conn, $_POST["contr_user"]);
    $query = "SELECT * FROM utenti";
    $res = mysqli_query($conn, $query) or die("Errore :".mysqli_error($conn));
    while($row =  mysqli_fetch_object($res)){
        if($row->username === $user || $user == ""){
            $check = true; //true = utente gia esistente o nullo
        }
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    echo $check; //false = utente OK
    exit;   
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="signup-style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://code.jquery.com/jquery-latest.js" defer></script>
        <script src="controllo-form.js" defer></script>
 
    </head>

    <body>
        <header>
            <h1>Benvenuto nella pagina di registrazione dell'HW1</h1>
        </header>
        <main>
            <form name='signup' method= 'post'>
                <p>
                    <label>Nome <input type='text' name='nome'></label>
                </p>
                <p>
                    <label>Cognome <input type='text' name='cognome'></label>
                </p>
                <p>
                    <label>E-mail <input type='text' name='email'></label>
                </p>
                <p>
                    <label>Nome utente <span id = 'user-exist-cont' class = 'hidden'></span><input type='text' name='username' id='user'></label>
                <p>
                    <label>Password <input type='password' name='password'></label>
                </p>
                <p>
                    <label>Conferma password <input type='password' name='confpassword'></label>
                </p>
                <p id='button-cont'>
                    <label><input type='submit' id = 'button'></label>
                </p>
                <a href="login.php">Hai già un account? Clicca qui</a>
            </form>
        </main>
        <div id = "alert" class = "hidden"></div>
    </body>

</html>

<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['pass'])) {
	header('Location: home.php');
	exit;
}
if(isset($_POST["nome"])&& isset($_POST["cognome"])&& isset($_POST["email"])&& isset($_POST["username"])&& isset($_POST["password"])&& isset($_POST["confpassword"])){
    $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $query = "INSERT INTO utenti(nome,cognome,email,username,pass) values('".$nome."','".$cognome."','".$email."','".$username."','".$password."')";
    $res = mysqli_query($conn, $query) or die("Errore :".mysqli_error($conn));
    mysqli_free_result($res);
    mysqli_close($conn);
    $_SESSION['username'] = $username;
	$_SESSION['pass'] = $password;
    header("Location: home.php");
    exit;
}
?>
