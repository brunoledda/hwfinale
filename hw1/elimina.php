<?php
if(isset($_POST['id_spotify'])&&isset($_POST['id_raccolta'])){
    $conn = mysqli_connect("localhost","root", "","hw1") or die("Errore: ".mysqli_connect_error());
    $id_risorsa = $_POST['id_spotify'];
    $id_raccolta = $_POST['id_raccolta'];
    //elimina da associazione
    $query = "DELETE from associazione where id_raccolta = '".$id_raccolta."' and id_contenuto = (select id_contenuto from contenuto where id_risorsa = '".$id_risorsa."')";
    mysqli_query($conn, $query);
    //elimina da contenuto
    $query2 = "DELETE from contenuto where id_contenuto not in (select a.id_contenuto from associazione a join raccolta r on a.id_raccolta = r.id_raccolta)";
    mysqli_query($conn, $query2);
    mysqli_close($conn);
}
?>