<?php
if(isset($_GET['id_raccolta'])){
    $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error()); 
    $id = $_GET['id_raccolta'];
    $query="SELECT c.img_url, c.titolo, c.id_risorsa FROM contenuto c JOIN associazione a 
    ON c.id_contenuto = a.id_contenuto WHERE a.id_raccolta = '".$id."'";

    $res=mysqli_query($conn, $query)or die("Errore :".mysqli_error($conn));
    $risultati=array();
  
    while($row=mysqli_fetch_assoc($res))
    {
        $risultati[]=$row;
    }
    echo json_encode($risultati);
    mysqli_free_result($res);
    mysqli_close($conn);
    exit;
}
?>