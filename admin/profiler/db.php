<?php

function connect(){
    return mysqli_connect("localhost","root","","profiler");
}

function query($query){
    return connect()->query($query);
}

/////////////////
//   SEZIONI   //
/////////////////

//Prendi Tutte Le Sezioni
function sezioniDelSitoDB(){
    return query("SELECT * FROM sezioni");
}

//Ellimana Una Sezione
function rimuoviSezioneDB($id) {
    return query("DELETE FROM sezioni WHERE id =". $id);
}

//Aggiungi Una Sezione
function aggiungiSezioneDB() {
    return query("INSERT INTO sezioni (url, nome, tipo_pagina) VALUES ('".$_POST['url']."', '".$_POST['nome']."', '".$_POST['tipologia']."'); ");
}



////////////////
//   UTENTI   //
////////////////

//Prendi Tutti Gli Utenti
function utentiDelSitoDB() {
    return query("SELECT * FROM visitatori");
}

//Prendi Singolo Utente
function utenteDelSitoDB($id) {
    return query("SELECT * FROM visitatori WHERE token =".$id);
}

//Prendi Dati Per Singolo Utente
function visitePerUtenteDB($id) {
    return query("SELECT * FROM visite v, visitatori u, sezioni s WHERE v.id_sezione = s.id AND v.token_utente = u.token AND v.token_utente =". $id);
}


////////////////
//    CRO     //
////////////////


function rimuoviCRODB($id) {
    return query("DELETE FROM interazioni WHERE id =". $id);
}

function aggiungiInterazioneDB($tipo, $val) {
    return query("INSERT INTO interazioni (id_sezione, tipo_filtro, valore_filtro, tipo_interazione, testo_interazione, nome_filtro)
        values ('".$_POST['id_sezione']."', '".$tipo."', '".$val."' , '".$_POST['tipo_interazione']."', '".$_POST['testo_interazione']."', '". $_POST['nome_filtro']."')");
}

function visualizzaInterazioniDB(){
    return query("SELECT *, t.nome as tnome, f.nome as fnome, s.nome as snome, i.id as iid FROM interazioni i, tipo_interazione t, sezioni s, filtri_ricerca f WHERE i.id_sezione = s.id AND t.id = i.tipo_interazione AND f.id = i.tipo_filtro");
}

function recuperaFiltri($id) {
    
    $tp = query("SELECT tipo_filtro, valore_filtro FROM interazioni where id =".$id)->fetch_assoc();

    switch($tp['tipo_filtro']) {

        case 1:
            echo "switch1";
            return query("SELECT * FROM interazioni, sezioni, visite, visitatori WHERE interazioni.id_sezione = sezioni.id AND sezioni.id = visite.id_sezione AND visite.token_utente = visitatori.token AND visite.visite > ".$tp['tipo_filtro']." AND interazioni.id =" .$id);
        case 2:
            echo "switch2";
            return query("SELECT * FROM interazioni, sezioni, visite, visitatori WHERE interazioni.id_sezione = sezioni.id AND sezioni.id = visite.id_sezione AND visite.token_utente = visitatori.token AND visitatori.ultima_visita > ".$tp['valore_filtro']." AND interazioni.id =" .$id);


    }

    return query("SELECT * FROM interazioni, sezioni, visite, visitatori WHERE interazioni.id_sezione = sezioni.id AND sezioni.id = visite.id_sezione AND visite.token_utente = visitatori.token AND interazioni.id =" .$id);
}