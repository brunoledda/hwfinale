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
        <title>Home</title>
        <link rel="stylesheet" href="home-style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="script-home.js" defer></script>
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
                    <h1>Benvenuto <?php 
                        echo $_SESSION['username'];
                        ?></h1>
                </header>
                <div id= "divider">
                    <img src="divider.png">
                </div>
                <p id ="content-title">Elenco delle tue Playlist:</p>
                <div id="grid">
                    <div id= "playlist-create" class="box">
                        <img src = "add.png" class="item">
                        <p class="item">Clicca per aggiungere una nuova Playlist</p>
                    </div>
                    <?php 
                        $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
                        $currUser = $_SESSION['username'];  
                        $query = "SELECT * FROM raccolta WHERE nome_utente = '".$currUser."'";
                        $res = mysqli_query($conn, $query) or die("Errore :".mysqli_error($conn));
                        while($row =  mysqli_fetch_object($res)){
                            echo "<div class ='box' id='playlist'>";
                            echo "<img src=".$row->img_url." class='item'>";
                            echo "<p class='item'>".$row->titolo."</p>";
                            echo "<p class='hidden'>".$row->id_raccolta."</p>";
                            echo "</div>";
                        }
                        mysqli_free_result($res);
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>
<?php
    if(isset($_POST['playlistTitle'])){
        $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
        $title = mysqli_real_escape_string($conn, $_POST["playlistTitle"]);
        $user = $_SESSION['username'];
        if ($title != '') {
            $query = "insert into raccolta(titolo, img_url, nome_utente) values('".$title."', 'empty.png', '".$user."')";
        }
        $res = mysqli_query($conn, $query) or die("Errore :".mysqli_error($conn));
        mysqli_free_result($res);
        mysqli_close($conn);
    }
?>