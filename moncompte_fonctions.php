<?php
/**
 * Plugin Mon Compte
 * (c) 2015 Mist. GraphX
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

function lister_panels(){
    $panels = pipeline('moncompte_ajouter_panel',array(
        'args'=>array(),
        'data'=>$panels
    ));
    return $panels;
}
