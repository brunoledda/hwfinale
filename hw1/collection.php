<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Raccolta</title>
        <link rel="stylesheet" href="home-style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="script-collection.js" defer></script>
    </head>
    <body>
        <main>
            <div id = 'menu'>
                <div id ="navbar">
                    <a href= "home.php">Home</a>
                    <a href= "search.php">Ricerca</a>
                    <a href= "logout.php">Logout</a>
                </div>
            </div>
            <div id ='content'>
                <header>
                    <h1>Raccolta</h1>
                </header>
                <div id= "divider">
                    <img src="divider.png">
                </div>
                <p id ="content-title">Elenco delle canzoni associate a questa raccolta:</p>
                <?php
                    if(isset($_GET['id_raccolta'])){
                        $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
                        $id_raccolta = $_GET['id_raccolta'];
                        $user = $_SESSION['username'];
                        $query = "SELECT * from raccolta where id_raccolta = '".$id_raccolta."'";
                        $res = mysqli_query($conn, $query) or die("Errore :".mysqli_error($conn));
                        while($row = mysqli_fetch_object($res)){
                            if($row->nome_utente != $user){
                                echo "<p>Errore: Questa raccolta non è associata al tuo account</p>";
                                exit;
                            }
                        }
                        echo "<p class= 'hidden' id = 'id_racc'>";
                        echo $id_raccolta;
                        echo "</p>";
                        mysqli_free_result($res);
                        mysqli_close($conn);
                    }
                
                ?>
                <section id= "modal-view" class ="hidden"></section>
            </div>
        </main>
    </body>
</html>