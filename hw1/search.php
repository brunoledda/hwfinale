<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: login.php');
	exit;
}
if(isset($_POST['richiesta'])){
    $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
    $currUser = $_SESSION['username'];  
    $query = "SELECT * FROM raccolta WHERE nome_utente = '".$currUser."'";
    $res = mysqli_query($conn, $query) or die("Errore :".mysqli_error($conn));
    $array = array();
    while($row =  mysqli_fetch_object($res)){
        $array[]=$row;    
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($array);
    exit;
}
if(isset($_POST['img_url'])&&isset($_POST['titolo'])&&isset($_POST['id_risorsa'])&&isset($_POST['id_raccolta'])){
    $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
    $user = $_SESSION['username'];
    $titolo = $_POST['titolo'];
    $immagine = $_POST['img_url'];
    $id_risorsa = $_POST['id_risorsa'];
    $id_raccolta = $_POST['id_raccolta'];    

    do {
		$query = "SELECT id_contenuto FROM contenuto WHERE id_risorsa = '$id_risorsa'";
		$res = mysqli_query($conn, $query);
		if(mysqli_num_rows($res) == 0) {
			$query = "INSERT into contenuto(titolo, id_risorsa, img_url) values('".$titolo."', '".$id_risorsa."', '".$immagine."')";
			mysqli_query($conn, $query);
		}
    } while(mysqli_num_rows($res) == 0);
    $query = "INSERT INTO associazione(id_raccolta, id_contenuto) values('".$id_raccolta."', (SELECT id_contenuto FROM contenuto WHERE titolo = '".$titolo."'))";
    $query2 = "UPDATE raccolta set img_url = '".$immagine."' WHERE id_raccolta = '".$id_raccolta."' AND img_url = 'empty.png'";   
    mysqli_query($conn, $query2);
    mysqli_query($conn, $query);
    mysqli_free_result($res);
    mysqli_close($conn);

}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ricerca</title>
        <link rel="stylesheet" href="home-style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="script-search.js" defer></script>
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
                    <h1>Ricerca</h1>
                </header>
                <div id= "divider">
                    <img src="divider.png">
                </div>
                <p id ="content-title">Scrivi qui un titolo/artista/album da cercare:</p>
                <form name='search' method= 'post' id="search-cont">
                    <p>
                        <label>Cerca: <input type='text' name='text'></label>
                    </p>
                    <p id='button-cont'>
                        <label><input type='submit' id = 'button'></label>
                    </p>
                </form>
                <div id = "result"></div>
            </div>
        </main>
    </body>
</html>