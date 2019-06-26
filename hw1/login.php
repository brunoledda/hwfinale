<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="login-style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="controllo-login.js" defer></script>
    </head>

    <body>
        <header>
            <h1>Benvenuto nella pagina di login dell'HW1</h1>
        </header>
        <main>
            <form name='login' method= 'post'>
                <p>
                    <label>Nome utente <input type='text' name='username' id='user'></label>
                <p>
                    <label>Password <input type='password' name='password'></label>
                </p>
                <p id='button-cont'>
                    <label><input type='submit' id = 'button'></label>
                </p>
                <a href="signup.php">Non sei ancora registrato? Clicca qui</a>
            </form>
        </main>
        <div id = "alert" class = "hidden">
        </div>
    </body>

</html>
<?php
session_start();
if(isset($_SESSION['username'])) {
	header('Location: home.php');
	exit;
}
if(isset($_POST["username"])&& isset($_POST["password"])){
    $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $exist= false;

    $query = "SELECT * FROM utenti";
    $res = mysqli_query($conn, $query) or die("Errore :".mysqli_error($conn));
    while($row =  mysqli_fetch_object($res)){
        if(($row->username === $username)&&($row->pass === $password)){
            $exist= true;
        }
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    if($exist){
        $_SESSION['username'] = $username;
		$_SESSION['pass'] = $password;
        header("Location: home.php");
        exit;
    }else{
        echo "<p id ='alert'>";
        echo "Username o password errati.";
        echo "</p>";
    }
}
?>