# Mon compte

Permet la gestion du compte utilisateur du site depuis l'espace public.

Fourni l'édition publique du profil utilisateur par défaut.

Si le plugin Newsletter est installé, un panneau newsletter est ajouté a la gestion du profil.
**Le plugin Mailsubscribers ne permet pas l'association a un profil auteur/visiteur seulement a une adresse mail,
ce panneau est donc relativement inutile pour le moment**

Si le plugin notification avancee est installé, la gestion des notifications est accessible :
- aucune notification listéees pour le moment



## Squelettes

Les squelettes suivent l'organisation Z,
on trouvera dans aside, le menu de navigation,
dans content, le squelettes incluant les panneaux et un breadcrumb/hierarchie.
Ces  squelettes peuvent êtres surchargés afin d'adapter le markup au site,
mais ne servent que de contrôleur pour les différent panneaux inclus.

Tout les panneaux sont placés dans un dossier `/moncompte` permettant de ne pas encombrer inutilement le dossier `content` ou `inclure`.

Un squelette accueil.html permet de personnaliser l'accueil de l'espace membre.


## Menu

Si le plugin menu est utilisé, on pourra y intégrer le menu Mon Compte, fourni avec le plugin.



## Pipeline

`moncompte_ajouter_panel` permet d'ajouter depuis des squelettes ou plugins,
des panneaux a l'espace mon compte.

Pour utiliser la pipeline, on ajoute au paquet.xml

`<necessite nom="MONCOMPTE" />`

`<pipeline nom="moncompte_ajouter_panel" inclure="monplugin_pipelines.php" />`


fichier `monplugin_pipelines.php`

````

/**
 * Mon Compte gestion des panels
 *
*/

function zshop_moncompte_ajouter_panel($panels){
    
    $panels['commandes'] = array(
        'title'=>'Mes commandes',
        'items'=>array(
                array('title'=>"Voir mes commandes",'url'=>'commandes_toutes'),
        )
    );
    
    $panels['abonnements'] = array(
        'title'=>'Mes abonnements',
        'items'=>array(
                array('title'=>'Tous mes abonnements','url'=>'abonnements_tous'),
        )
    );
    
    $panels['adresses'] = array(
        'title'=>'Livraisons et adresse',
        'items'=>array(
                array('title'=>'Gérer mes adresses','url'=>'adresses_toutes'),
        )
    );
    
        
        
    return $panels;
}

````

Ajouter des menus à un panel existant :

````
function monplugin_moncompte_ajouter_panel($panels){

    	$new_item['profil']['items'][] = array('title'=>'Newsletter','url'=>'test_page');
    
    	$panels = array_merge_recursive($panels, $new_item);
	$return $panels;
}

````

## TODO

- [ ]   Autres plugins a intégrer :  
        Gestion d'abonements a des alertes sur des objets spip : http://www.kokmoka.com/plugins-spip-alertes/

