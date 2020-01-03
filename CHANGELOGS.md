# Changelogs

* surcharge du système de récupération du mot de passe de la dist spip (formulaire/oubli)
* la notification d'oubli de mot de passe est déplacé dans emails/oubli 


1.1.7 :

* ajout de chaines de langues spécifique au formulaire inscription rapide
* report dans le modèle email envoyé
* dans la page d'accès a moncompte le formulaire login renvoye sur la page
* dans le mail reçut l'url est celle de l'accès compte client

1.1.6

* Chaines de langue sur la gestion des inscriptions aux newsletters

1.1.5

* chaine de langue personalisable acceuil_introduction

1.1.4

* ajout a la page accueil d'un lien vers l'espace privé si autorisé

1.1.3

formulaire d'inscription rapide :
- l'utilisateur doit saisir deux fois sont email afin d'éviter une erreur de frappe
- l'enregistrement du domaine de l'email saisie est vérifié


1.1.2

sécurité suppression de code mort/test de gestion produits stocks en mode public

1.1

- changement de la structure z : on utilise uniquement content/
- ajout d'un repertoire emails/ dédiés au messages envoyés via facteur
- ajout du mail envoyé via facteur
 d'inscription_rapide utilisée par le formulaire inscription_rapide
- surcharge des chaines de langues spip_form form_forum_xx


Thu Sep 29 08:58:11 2016
:   *   Les liens de menu sont en nofollow, pour éviter l'indexation

Fri Sep 02 15:25:06 2016
:   *   le menu mon compte, renvoie vers la page : identification
        qui comporte le formulaire d'inscription rapide et le formulaire d'identification

- Ajout du paneau gestion des notifications :
    - ne liste aucune notifications pour le moment

-   ajout de la page identification
    la page affiche la connection et l'inscription au site

Sun Mar 20 15:03:31 2016
:   *   	ajout d'une page de connection/inscription
