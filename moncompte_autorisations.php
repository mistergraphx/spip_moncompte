<?php
/**
 * Plugin Mon Compte
 * (c) 2015 Mist. GraphX
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/*
 * Un fichier d'autorisations permet de regrouper
 * les fonctions d'autorisations de votre plugin
 */

// declaration vide pour ce pipeline.
function moncompte_autoriser(){}


/* Exemple
function autoriser_configurer_moncompte_dist($faire, $type, $id, $qui, $opt) {
	// type est un objet (la plupart du temps) ou une chose.
	// autoriser('configurer', '_moncompte') => $type = 'moncompte'
	// au choix
	return autoriser('webmestre', $type, $id, $qui, $opt); // seulement les webmestres
	return autoriser('configurer', '', $id, $qui, $opt); // seulement les administrateurs complets
	return $qui['statut'] == '0minirezo'; // seulement les administrateurs (même les restreints)
	// ...
}
*/

/**
 * Autoriser les utilisateurs à modifier leur profil
 * 
 * On garde les autorisations par défaut pour les administrateurs et les rédacteurs
 * Par contre on autorise les visiteurs (6forum) à modifier un profil:
 * -* s'il sont eux même l'utilisateur à modifier
 * -* s'ils ont le bon statut
 * -* si on ne souhaite pas modifier le statut
 *
 * @param string $faire
 * @param string $type
 * @param int $id
 * @param array $qui
 * @param array $opt
 */
if (!function_exists('autoriser_auteur_modifier')) {
    function autoriser_auteur_modifier($faire, $type, $id, $qui, $opt) {
            // Admin ou redacteur => On utilise la fonction par défaut
            if (in_array($qui['statut'], array('0minirezo', '1comite')))
                    return autoriser_auteur_modifier_dist($faire, $type, $id, $qui, $opt);
            // Un utilisateur normal n'a jamais le droit de modifier son statut
            // Ni les champs qui ne sont pas dans _fiche_mod
            else if(isset($opt['champ'])){
                    return
                            !$opt['statut']
                            //AND (lire_config('inscription3/'.$opt['champ'].'_fiche_mod','off') == 'on')
                            AND $qui['statut'] == '6forum'
                            AND $id == $qui['id_auteur'];	
            }else
                    return
                            !$opt['statut']
                            AND $qui['statut'] == '6forum'
                            AND $id == $qui['id_auteur'];
            }
}