<?php
/**
 * Plugin profils
 * Gestion des comptes profils
 * (c) 2011 Nursit.net
 * Licence GPL
 *
 */
if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Inscription rapide d'un client, sans confirmation email, par simple saisie email
 * @param string $statut
 * @param string $retour
 * @return array
 */
function formulaires_inscription_rapide_charger_dist($statut='6forum', $retour='') {

	$inscription_charger = charger_fonction("charger","formulaires/inscription");
    $valeurs = $inscription_charger($statut);
    $valeurs['mail_inscription_verif'] = '';
	return $valeurs;
}

/**
 * Inscription rapide d'un client, sans confirmation email, par simple saisie email
 * Si inscriptions pas autorisees, retourner une chaine d'avertissement
 *
 * @param string $statut
 * @param string $retour
 * @return array
 */
function formulaires_inscription_rapide_verifier_dist($statut='6forum', $retour='') {

    // fournir le nom à partir de l'email
	$nom = _request('mail_inscription');
	$nom = explode('@',$nom);
	$nom = reset($nom);
	$nom = preg_replace(",[-_\.],"," ",$nom);
	$nom = ucwords($nom);
	set_request('nom_inscription',$nom);
	$inscription_verifier = charger_fonction("verifier","formulaires/inscription");

	$erreurs = $inscription_verifier($statut);
    // Verifier que l'email et email_verif sont identique
    if(_request('mail_inscription') != _request('mail_inscription_verif')){
        $erreurs['mail_inscription'] = "Les deux emails ne sont pas identiques";
    }
    // Vérifier que le domaine de l'email saisi existe
    if(! domain_exists(_request('mail_inscription'))){
        list( $user, $domain ) = explode( '@', _request('mail_inscription') );
        $erreurs['mail_inscription'] = "Le domaine ".$domain." ne semble pas être valide";
    }

	return $erreurs;
}

/**
 * Inscription rapide d'un client, sans confirmation email, par simple saisie email
 * @param string $statut
 * @param string $retour
 * @return array
 */
function formulaires_inscription_rapide_traiter_dist($statut='6forum', $retour='') {

	$inscription_traiter = charger_fonction("traiter","formulaires/inscription");
	$res = $inscription_traiter($statut);

	// confirmer directement l'inscription, sans attendre validation de l'email
	// et autologer
	if (isset($res['id_auteur']) AND $id_auteur=$res['id_auteur']){
		sql_updateq('spip_auteurs',array('cookie_oubli'=>'','statut'=>$statut),'id_auteur='.intval($id_auteur));

		include_spip('inc/auth');
		$auteur = sql_fetsel("*","spip_auteurs","id_auteur=".intval($id_auteur));
		auth_loger($auteur);
	}

	if ($retour){
		$res['redirect'] = $retour;
	}
	return $res;
}

/**
 * domain_exists()
 *
 * test si le domaine du email saisi existe
 *
 * https://davidwalsh.name/php-email-validator
 *
 * @param $email - email
 * @param $record - MX
 * @return return type
 */
function domain_exists($email, $record = 'MX'){
    list( $user, $domain ) = explode( '@', $email );
	return checkdnsrr( $domain, $record );
}

/**
 * construction du mail envoyant les identifiants
 * fonction redefinie qui doit retourner un tableau
 * dont les elements seront les arguments de inc_envoyer_mail
 *
 * http://doc.spip.org/@envoyer_inscription_dist
 *
 * @param array $desc
 * @param string $nom
 * @param string $mode
 * @param array $options
 * @return array
 */
function envoyer_inscription($desc, $nom, $mode, $options=array()) {

	$contexte = array_merge($desc,$options);
	$contexte['nom'] = $nom;
	$contexte['mode'] = $mode;

	$message = recuperer_fond('emails/mail_inscription_rapide',$contexte);
	$from = (isset($options['from'])?$options['from']:null);
	$head = null;
	return array("", $message,$from,$head);
}
