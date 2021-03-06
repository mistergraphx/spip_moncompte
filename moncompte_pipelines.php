<?php
/**
 * Plugin Mon Compte
 * (c) 2015 Mist. GraphX
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * pipeline moncompte_ajouter_panel
 *
 * Provide a pipeline to insert panels and sub-items from others plugins
 *
 * @param {array} panels - an array of panels & sub items
*/
function moncompte_moncompte_ajouter_panel($panels){

    $panels = array('profil'=>array(
        'title'=>'Profil',
        'items'=> array(
                array('title'=>"Modifier mon Profil",'url'=>'profil_modifier'),
        )
    ));

    if(test_plugin_actif('newsletters')){
        $panels['profil']['items'][] = array('title'=>'Gérer mes inscriptions','url'=>'profil_newsletters');
    }

    return $panels;
}
