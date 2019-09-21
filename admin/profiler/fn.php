<?php

function alert($color, $text){
	$html = '<div class="alert alert-'.$color.' alert-dismissible show" role="alert">';
	$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
	$html .= '<span aria-hidden="true">&times;</span></button>';
	$html .= $text;
	$html .= '</div>';
	
	return $html;
}

/////////////////
//   SEZIONI   //
/////////////////

//Prendi Tutte Sezioni
function controllaSezioni() {
    return sezioniDelSitoDB();
}

function confermaEliminazione($id){
    if(rimuoviSezioneDB($id))
        return ["success", "Sezione Rimossa Correttamente"];
    else
        return ["danger", "Un Errore ha impedito la Cancellazione della Sezione.\nRiprova"];
}

//Aggiunta Sezione
function aggiungiSezione() {

    $erroreTesto = "";

    if(isset($_POST['url']))
        $_POST['url'] = addslashes($_POST['url']);
    else
        $erroreTesto += "Manca L'url\n";

    if(isset($_POST['nome']))
        $_POST['nome'] = addslashes($_POST['nome']);
    else
        $erroreTesto += "Manca il nome\n";

    if(strlen($erroreTesto) > 0) {

        return ["danger", $erroreTesto];
    } else {

        if(aggiungiSezioneDB())
            return ["success", "Sezione Aggiunta Correttamente"];
        else
            return ["danger", "Un Errore ha impedito la Creazione della Sezione.\nRiprova"];

    }
}

////////////////
//   UTENTI   //
////////////////

//Prendi Tutti Gli Utenti
function utentiDelSito() {
    return utentiDelSitoDB();
}

//Prendi Singolo Utente
function utenteDelSito() {
    $_GET['dettaglio'] = addslashes($_GET['dettaglio']);
    return utenteDelSitoDB($_GET['dettaglio']);
}

//Prendi Dati Per Singolo Utente
function visitePerUtente() {
    $_GET['dettaglio'] = addslashes($_GET['dettaglio']);
    return visitePerUtenteDB($_GET['dettaglio']);
}


////////////////
//    CRO     //
////////////////

function visualizzaInterazioni() {
    return visualizzaInterazioniDB();
}

//Aggiunta Interazione
function aggiungiInterazione() {
    $erroreTesto = "";

    if(isset($_POST['id_sezione']))
        $_POST['id_sezione'] = addslashes($_POST['id_sezione']);
    else
        $erroreTesto .= "Non hai selezionato la Sezione\n";

    $ok_filtro = false;
    if(isset($_POST['checkboxvar'])) {

        foreach($_POST['checkboxvar'] as $key => $tmp) 
            if((strlen($tmp) > 0)) {
                if(($_POST['checkboxval'][$key]) == "") {
                    $ok_filtro = false;
                    break;
                } else {
                    $ok_filtro = true;
                }
            }
    }

    if(!$ok_filtro)
        $erroreTesto .= "I valori inseriti per il filtro non sono corretti\n";   

    if(strlen($_POST['testo_interazione']) == 0)
        $erroreTesto .= "Non hai inserito il contenuto dell'Interazione\n"; 

    if(strlen($erroreTesto) > 0) {

        return ["danger", $erroreTesto];
    } else {

        foreach($_POST['checkboxvar'] as $key => $tmp) 
            if((strlen($tmp) > 0)) {
                if(!(aggiungiInterazioneDB($_POST['checkboxvar'][$key], $_POST['checkboxval'][$key])))
                    return ["danger", "Un Errore ha impedito la Creazione dell'Interazione.\nRiprova"];
            }
        return ["success", "Interazione Aggiunta Correttamente"];
    }
}