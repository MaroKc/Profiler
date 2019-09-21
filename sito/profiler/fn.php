<?php

function controllaSessione(){
    if(isset($_SESSION['token'])){

    }
    else{
        if(isset($_COOKIE['token'])) {
            $_SESSION['token'] = $_COOKIE['token'];
        }
        else{
            $_SESSION['token'] = creaNuovoUtente();
            setcookie('token', $_SESSION['token'], time() + (86400 * 30), "/");
        }

        aggiungiVisitaGlobale();
    }

    iniziaControlli();
}

function iniziaControlli(){
    controllaSezioni();
}

//RINOMINA RICORDA
function controllaSezioni(){
    return analizzaSezioni('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}


function analizzaSezioni($url, $js = false){
    $current_url = $url;
    $sezioni = sezioniDelSito();
    $id_sezione = null;
    
    while($s = $sezioni->fetch_assoc()){
        if($s['url'] == $current_url && $s['tipo_pagina'] == 0){
            $id_sezione = $s['id'];
            break;
        }
        elseif(strpos($current_url, $s['url']) >= 0 && $s['tipo_pagina'] == 1){
            $id_sezione = $s['id'];
            break;
        }
    }
    
    if($id_sezione) {
        if(!$js)
            aggiungiVisitaSezione($id_sezione);
        
        $interazioni = controllaFiltro($id_sezione);

        while($i = $interazioni->fetch_assoc()){

            $arr = [];
            
            if($i['tipo_filtro'] == 1) {
                // N visite alla pagina

                $visite = ottieniVisitePagina($id_sezione);

                if ($visite >= $i['valore_filtro']) {
                    $arr['html'] = $i['testo_interazione'];
                }
            } elseif ($i['tipo_filtro'] == 2) {
                // Recency
                
                $recency = ottieniRecency($id_sezione)->fetch_assoc()['ultima_visita'];
                if ($recency <= date("d/m/Y",time()-(86.400*$i['valore_filtro'])) {

                    $arr['html'] = $i['testo_interazione'];
                }
            }
            
            $arr['tipo'] = $i['tipo_interazione'] == 1 ? 'popup' : 'header';
            // print_r($arr);
            return $arr;
        }
    }    
}