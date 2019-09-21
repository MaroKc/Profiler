
<?php

function connect(){
    return mysqli_connect("localhost","admin","password","profiler");
}

function query($query){
    return connect()->query($query);
}

function sezioniDelSito(){
    return query("SELECT * FROM sezioni");
}

function aggiungiVisitaGlobale(){
    $id = $_SESSION['token'];
    $date = date('Y-m-d H:i:s');

    query("UPDATE visitatori SET ultima_visita = '".$date."' WHERE token = '".$id."' ");
}

function creaNuovoUtente(){
    $conn = connect();
    $date = date('Y-m-d H:i:s');
    $conn->query("INSERT INTO visitatori (ultima_visita) VALUES ('".$date."'); ");
    $id = $conn->insert_id;

    return $id;
}

function aggiungiVisitaSezione($id){
    $visite = query("SELECT * FROM visite WHERE id_sezione = '".$id."' AND token_utente = '".$_SESSION['token']."' ");
    
    if(mysqli_num_rows($visite)){
        $date = date('Y-m-d H:i:s');

        query("UPDATE visite SET visite = visite + 1, ultima_visita = '".$date."'  WHERE id_sezione = '".$id."' AND token_utente = '".$_SESSION['token']."' ");
    }else{
        query("INSERT INTO visite (id_sezione, token_utente, visite) VALUES ('".$id."', '".$_SESSION['token']."', 1); ");
    }
}

function controllaFiltro($id) {
    return query("SELECT * FROM interazioni WHERE id_sezione = '".$id."'");
}

function ottieniVisitePagina($id) {
    $visite = query("SELECT * FROM visite WHERE id_sezione = '".$id."' AND token_utente = '".$_SESSION['token']."'");

    if (mysqli_num_rows($visite) == 0) {
        return 0;
    }
    return $visite->fetch_assoc()['visite'];
}

function ottieniRecency($id) {
    return query("SELECT * FROM visite WHERE id_sezione = '".$id."'");
}