					-----------------
					---- SYMFONY ----
					-----------------

ETAPE 0 : MVC (Model Vue Controller)
INTRO : Qu'est-ce Symfony
ETAPE 1 : Installation du framework Symfony 3.4
ETAPE 2 : Les bundles
ETAPE 3 : Les routes et controllers
ETAPE 4 : Notre boutique
ETAPE 5 : TWIG
ETAPE 6 : ASSETS
ETAPE 7 : Les entités (Mapping)
ETAPE 8 : DOCTRINE (DBAL - DQL)
ETAPE 9 : Les formulaires
ETAPE 10 : Validation des données
ETAPE 11 : Association mapping
ETAPE 12 : Sécurité et Utilisateur
ETAPE 13 : Symfony 4
BONUS 1 : Mise en prod
BONUS 2 : Formulaire de contact

----------------------------------

INTRO : Qu'est-ce Symfony

	1/ Avantages à utiliser un framework du marché
		A/ Organisation optimisée
		B/ Fonctionnalités communes entre tous nos projets
		C/ Services disponibles (Routing, sécurité, BDD, moteur de template, formulaire)
		D/ Communauté

	2/ Choix du framework
		A/ Propre Framework (bonne expérience)
		B/ Les framework fullstack (Symfony, Laravel, zend, cake)
		C/ Les mini-framework (silex, Slim, CodeIgniter, lumen...)

	3/ Symfony
		 -> framework français
		 -> Versions :
			LTS (Long Time Support)
				v2.8
				v3.4 --> 2.8 plus souple, et avec des fonctionnalités retirées

				v4.2 :
					- PHP 7.1
					- Flex
					- Bundleless

------------------------------------------------
ETAPE 1 : Installation du framework Symfony 3.4
------------------------------------------------
Sommaire :
1/ Installer Composer
2/ Installer SF 3.4
3/ Arborescence des dossiers et fichiers
4/ Lancement de l'application

1/ Installer Composer
	- Composer est un outils qui permet de gérer les dépendances. Il permet de télécharger et de mettre à jour tous les outils dont on a besoin.

	- Télécharger :
		https://getcomposer.org/download/
		Composer-Setup.exe

	- Installer :
		- Suivre les étapes

2/ Installer SF 3.4
	- Dossier : htdocs/formation_pierrefitte/symfony/
	- Maj + Clic-droit : "Ouvrir la fenetre powershell ici"

	<cmd>
	composer create-project symfony/framework-standard-edition Test


3/ Arborescence des dossiers et fichiers
	- app/ : Configuration de notre application
	- bin/ : Les exécutables
	- src/ : Le dossier dans lequel on va mettre tout notre code (MVC)
	- var/ : Les fichiers écris SF : Log, le cache...
	- tests/ : Tous les tests unitaire
	- web/ : Repertoire web (images, CSS, JS, Fonts)... la clé d'entrée de l'app (index.php --> app.php ou app_dev.php)

	composer.json : Contient toutes les dépendances dont a besoin.

	- vendor : Le coeur de Symfony... on toucheras jamais à ce code !

4/ Lancement de l'application

	Méthode 1 :
	Prod : localhost/formation_pierfitte/symfony/test/web/app.php
	Dev : localhost/formation_pierfitte/symfony/test/web/app_dev.php


	Méthode 2 : (server interne)

	<cmd>
	cd Test
	php bin/console server:run

	Navigateur :
	localhost:8000


Lorsqu'on est en prod, on ne voit pas les erreurs, mais lorsqu'on est en mode DEV on voit les erreurs :

	localhost:8000/toto/
	localhost/formation_pierfitte/symfony/test/web/app.php/toto

---------------------
ETAPE 2 : Les bundles
---------------------
Sommaire :
1/ Le concept des Bundles
2/ Création de notre premier Bundle
----------------------

1/ Le concept des Bundles

	- Un bundle c'est une brique de notre application (Module)

	- User : (Connecter, deconnecter, inscrire etc...)
			 -> UserController (C)
			 -> UserModel (M)
			 -> vues : inscription/Connexion...


	===> Avec le temps, on considère plus "propre" de créer un seul Bundle (AppBundle)


2/ Création de notre premier Bundle

	<cmd> Test --> MAJ + CLIC-DROIT : ouvrir fenêtre powershell
	php bin/console generate:bundle

	--> POLES/TestBundle
	--> POLESTestBundle
	--> src/
	--> annotation


	==> Notre bundle a été créé mais il faut enregistrer le namespace POLES dans composer.json

	--> Mise à jour de composer.json
	<code>
	"psr-4": {
            "AppBundle\\": "src/AppBundle",
			"POLES\\": "src/POLES"
        },

	--> Mise à jour de l'app
	<cmd>
	composer update

	--> On modifie la fonction render dans notre controller :
	<code>DefaultController.php
	return $this->render('@POLESTest/Default/index.html.twig');

	===>  A ce stade la page d'accueil affiche 'hello World', notre Bundle est prêt à fonctionner !

-----------------------------------
ETAPE 3 : Les routes et controllers
-----------------------------------
Sommaire :
1/ Création de nos routes
2/ L'objet Request
3/ L'objet Response
4/ Redirection
5/ Message
----------------------

1/ Création de nos routes
	("/") -> route simple homepage
    ("/bonjour/") -> route echo (erreur)
    ("/bonjour2/") -> route response
    ("/hello/{prenom}") -> route response + param URL
    ("/hola/{prenom}") -> route render de vue + param URL
    ("/ciao/{prenom}/{age}") -> route render de vue + 2 params URL
    ("/redirect/") -> route avec redirection (RedirectResponse)
    ("/redirect2/") -> route avec redirection (redirectToRoute)
    ("/message") -> route avec redirect et message en session

2/ L'objet Request

	<code>
	use Symfony\Component\HttpFoundation\Request;

	Correspond à la requête HTTP (Post, get, Session...)... Il nous permettra par exemple de gérer les infos dans un formulaire.

	<ex code>
	$session = $request -> getSession();


3/ L'objet Response

	<code>
	use Symfony\Component\HttpFoundation\Response;

	Nous permet de gérer la partie response de la requete HTTP (retourner du texte simple).

4/ Redirection

	<code>
	use Symfony\Component\HttpFoundation\RedirectResponse;

		Permet d'effectuer des redirections (important)

		Méthode 1 : via l'objet Redirect Response
		<code>
		$route = $this -> get('router') ->  generate('accueil');
		return new RedirectResponse($route);

		Méthode 2 : via le controller
		<code>
		return $this -> redirectToRoute('accueil');

		/!\ A ce stade, et à partir de maintenant toutes nos route doivent avoir un name.


5/ Message

	$session  -> getFlashBag() -> add() permet de stocker des messages en session (exploitables dans les vues)

    Dans les vues, app.(cf message.html.twig) est une variable twig qui permet d'accéder aux infos en session.
    ex : app.session - app.user


---------------------------
ETAPE 4 : Notre boutique
----------------------------
Sommaire :
1/ Créer un nouveau projet SF
2/ Réorganiser le AppBundle
3/ Création des premieres routes



1/ Créer un nouveau projet SF

	<cmd> htdocs/formationpierrefitte/symfony
	composer create-project symfony/framework-standard-edition Boutique3
	cd Boutique3
	php bin/console server:run

2/ Réorganiser le AppBundle

	Controleur :
	DefaultController -> ProduitController
	MembreController
	CommandeController

	Vues :
	Resources/views
		- Produit (boutique, fiche_produit, boutique/categorie)
		- Membre (inscription, connexion, profil...)
		- Commande (panier, paiement, transport, codepromo)


3/ Création des premieres routes

	"/"
	"/produit/{id}/"
	"/categorie/{cat}/"
	"/inscription/"
	"/connexion/"
	"/profil/"


---------------
ETAPE 5 : twig
---------------
Sommaire
1/ Créer un layout
2/ L'héritage TWIG
3/ Modification de nos vues
4/ Documentation TWIG
---------------

Twig est le moteur de template de Symfony. Un moteur de template (tpl, blade, Twig, smarty...) permet d'afficher du PHP dans les vues HTML plus simplement.

	exemple :
		<?= $membre['prenom'] ?>
		{{ membre.prenom }}


1/ Créer un layout
	Un layout (app/Resources/views/layout.htm.twig), est une structure de page (un template).
	Le concept de layout nous permet d'avoir plusieurs structures de pages dans notre site (ex : front + Back).


2/ L'héritage TWIG
	Avec twig, on parle d'héritage. Un layout créé des block dans lesquels on va pouvoir afficher du contenu.
	Les vues héritent donc d'un layout et complètent les block.

3/ Modification de nos vues
	<code>
	{% extends 'layout.html.twig' %}
	{% block content %}
		Contenu de la page
	{% endblock %}

	/!\ Lorqu'on utilise l'héritage TWIG, nos vues ne peuvent contenir de l'HTML qu'à l'intérieur d'un block

4/ Documentation TWIG

	https://twig.symfony.com/doc/2.x/



A FAIRE :
	Effectuer l'affichage (grâce à l'héritage TWIG) de toutes nos routes actuellement créées.

	"/" ---> Produit/index.html.twig
	"/produit/{id}/"  ---> Produit/produit.html.twig
	"/categorie/{cat}/" ----> Produit/index.html.twig
	"/inscription/"   ---> Membre/inscription.html.twig
	"/connexion/"   --->  Membre/connexion.html.twig
	"/profil/" ---> Membre/profil.html.twig


	AdminController :
	Créer le fichier src/Controller/AdminController.php
	Routes CRUD - Produit :
		(au clic sur gestion Produit)
		"/admin/produit/", name="produit_list"
		views/Admin/produit_list.html.twig

		"/admin/produit/add/", name="produit_add"
		views/Admin/produit_form.html.twig

		"/admin/produit/update/{id}/", name="produit_update"
		views/Admin/produit_form.html.twig

		"/admin/produit/delete/{id}/", name="produit_delete"
		---> redirection 'produit_list' + message de validation

--------------------
ETAPE 6 : Les assets
--------------------
Sommaire :
1/ Modifier Composer.json
2/ Mise à jour de l'app
3/ Modification des vues (assets et paths)
----------------------------------------

------------------------------------
ETAPE 7 : Nos entités (Doctrine ORM)
------------------------------------
Sommaire :
0/ Création de la BDD
1/ Doctrine ORM et le concept d'entity
2/ Créer entité Produit
3/ Annotations
4/ Mettre à jour la BDD
5/ Générer une entité en ligne de Commande
6/ Générer la BDD via les entités
7/ Générer Les entités via la BDD
------------------------------------
1/ Doctrine ORM et le concept d'entity

  - D'une certaine manière, les entités correspondent à la partie model de notre MVC. C'est la relation avec la BDD, mais sous forme de PHP et non de SQL. Merci Doctrine !

  - ORM : Object Relation Mapping

  - Normalement nous devrions plus faire de SQL à partir de maintenant.

  - Nous allons créé nos entités sous forme de class PHP (POPO : Plain Old PHP Object), qui vont permettre à Doctrine de manipuler les tables en BDD.

  - Par exemple nous ne ferons plus de requete INSERT, on fera juste un objet produit
    $pdt = new Produit;
    persist($pdt);

  ===> Pour que tout cela soit possible, il faut "expliquer" à doctrine quelle relation il existe entre nos entités et la BDD --> Object Relation Mapping.


2/ Créer entité Membre

  A/ Créer un dossier Entity/ dans notre AppBundle
  B/ Créer un fichier Membre.php
  C/ On créer les propriétés private et les getter/setter

  --> On peut juste crééer les propriété et la console génere les setter/getter
  <cmd>
  php bin/console doctrine:generate:entities AppBundle


3/ Annotations

  - Avec Doctrine ORM, on paramètre le mapping via des annotations.
  <code>
  use Doctrine\ORM\Mapping\ as ORM;

  - Voir le fichier Entity/Membre.php, et les annotations qui déclarent le mapping avec la BDD.

  /!\ Attention les annotations de la clé primaire sont plus longues détaillés !

  Liens :

  Basic Mapping : https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/basic-mapping.html

  Association Mapping :https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html


4/ Mettre à jour la BDD
  - Pour tester la mise à jour de la BDD, nous avons choisi de remplacer pseudo par username, et mdp par password dans l'entité Membre. (et getter et setter...)

  <cmd>
  php bin/console doctrine:schema:update --dump-sql

  -> commande permettant de voir si tout est ok, et générant la requête qui va modifier la BDD

  <cmd>
  php bin/console doctrine:schema:update --force

  -> Commande qui exécute la requête et donc modifie la BDD depuis les entités (bien mappées)


5/ Générer une entité en ligne de Commande

  <cmd>
  php bin/console doctrine:generate:entity

  -> Name : AppBundle:Produit
  -> Puis on suit les différentes étapes.


6/ Générer la BDD via les entités

  - <cmd>
  php bin/console doctrine:schema:update --dump-sql
  php bin/console doctrine:schema:update --force


7/ Générer Les entités via la BDD


  -> php bin/console doctrine:mapping:import AppBundle\Entity annotation

  ==> cela génère nos entity, mais sans les getter et setter.

  Pour ajouter Getter et setter, mais aussi créer les repository
  on va :



    A/ Dans chaque entity ajouter ceci :
    @ORM\Entity(repositoryClass="BoutiqueBundle\Repository\ProduitRepository")

    B/
    <cmd>
      <cmd>
		php bin/console doctrine:generate:entities AppBundle

    => Met à jours les entités.

    /!\ Cette commande est dépréciée et devra être remplacée par une commande du bundle Maker. Qui nécessite le Bundle FLEX ---> SF 4

-------------------------------------
ETAPE 8 : DOCTRINE
-------------------------------------
Sommaire :
1/ Le service DOCTRINE
2/ Accéder au service Doctrine depuis les controller
3/ Requetes select * from
4/ Requetes select * from ... where id =
5/ Requetes select * from ... where .... = ....
6/ REQUETE INSERT/UPDATE
7/ REQUETE DELETE
8/ Create Query et Query Builder
-----------------------------------

1/ Le service DOCTRINE

Doctrine est un service (composant) très puissant de SF. D'ailleurs il s'utilise également dans d'autres framework.

Doctrine fait deux choses :
	- ORM (Object Relation mapping):
	Il permet de lier les entités de notre BDD (les tables) à des objets. A chaque fois qu'on va manipuler la BDD, en réalité nous manipulerons des objets (table Produit --> objet de la classe Produit)

	- Doctrine DBAL (DataBase Abstract Layer) :
	Le DBAL est une couche au-dessus de PDO. A partir de maintenant, on ne fera plus de SQL... on utilisera du DQL (Doctrine Query Language).

	- En résumé Doctrine nous fournis des fonctions simples pour faire des SELECT, INSERT, UPDATE, DELETE...

2/ Accéder au service Doctrine depuis les controller

- On doit use la (les) entités
    <code>
    use AppBundle\Entity\Produit

    - On fait appel à un repository pour manipuler une entité
    <code>
    $repository = $this -> getRepository(Produit::class);

    $em = $this -> getDoctrine() -> getManager();



3/ Requetes select * from

	<code>
	$repository = $this -> getDoctrine() -> getRepository(Produit::class);
	$produits = $repository -> findAll();



4/ Requetes select * from ... where id =

	<code>
	$repository = $this -> getDoctrine() -> getRepository(Produit::class);
	$produit = $repository -> find($id);

	$em = $this -> getDoctrine() -> getManager();
	$produit = $em -> find(Produit::class, $id);


5/ Requetes select * from ... where .... = ....

	<code>
	$produits = $repository -> findBy(['categorie' => $cat]);
	$produits = $repository -> findBy(array('categorie' => $cat));

	$produits = $repository -> findOneBy(['titre' => 'super tshirt']);


	// Tous les produits de catégories tshirt, de couleur rouge, dans l'ordre du prix decroissant, en affichant les 10 premiers résultats :
	$produits = $repository -> findBy(['categorie' => 'tshirt', 'couleur' => 'rouge'], ['prix' => 'DESC'], 10, 0);

	SELECT * FROM produit WHERE categorie = 'tshirt' AND couleur = 'rouge' ORDER BY prix DESC LIMIT 0, 10


	==> FindBy embarque beaucoup d'options, il faut avoir la doc ouverte pour paramétrer finement une requête.


6/ REQUETE INSERT/UPDATE
	 - Pour insérer un enregistrement en BDD, on instancie un objet de la classe (Entity), on affecte les valeurs (normalement issues d'un formulaire)
       <code>
       $produit = new Produit;
       $produit
			-> setReference('XXX')
			-> setTitre('xxx')
			etc...

       - Et ensuite, on persist l'objet, ce qui signifie que doctrine l'a pris en compte pour l'enregistrer en BDD
       <code>
       $em -> persist($produit);

       - Enfin pour l'enregistrer on flush()
       <code>
       $em -> flush();

		- Pour update un enregistrement, la logique est la même que pour INSERER sauf qu'au lieu d'avoir un objet vide, et rempli par le formulaire, on va récupérer l'objet à modifier, et le formulaire va apporter des modif. Puis on persist() on flush().

       --> CF la route de AdminController : /admin/produit/update

7/ REQUETE DELETE
	- Pour supprimer un enregistrement, on récupère l'objet correspondant, et on exécute sur cet objet la fonction remove() de Doctrine, puis flush()

      <code>
      $produit = $em -> find(Produit::class, $id);
      $em -> remove($produit);
      $em -> flush();

      --> CF la route de AdminController : /admin/produit/delete


8/ Create Query et Query Builder
	- Doctrine nous permet de manipuler des enregistrements via des objets (Entity), simplement grâce à des fonctions (find, findall, findBy, findOneBy, persist, remove, flush)

	- Mais on pourrait avoir besoin de requêtes plus "spécifiques". Doctrine nous fournit deux outils pour cela :


	CreateQuery() : Permet d'exécuter du SQL (DQL).
	-> cf ProduitRepository

	QueryBuilder : Permet d'écrire des requêtes sous forme de fonction PHP (Doctrine)
	-> cf ProduitRepository


		==> Idéalement, ces requêtes spécifiques ne sont pas codées dans les controleurs, mais dans les repository. Pour les deux raisons suivantes :
		1/ Pour les utiliser plus simplements par la suite à divers endroits.
		2/ Pour factoriser le code, le rendre plus simple plus lisible.

		<code dans le repository>
		$em = $this -> getEntityManager();
		au lieu de

		<code dans le controller>
		$em = $this -> getDoctrine() -> getManager();


		Liens :
		Doctrine :
		https://www.doctrine-project.org

		QueryBuilder : https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/query-builder.html

		CreateQuery :
		https://hotexamples.com/examples/doctrine.common.persistence/ObjectManager/createQuery/php-objectmanager-createquery-method-examples.html


-------------------------
ETAPE 9 : Les formulaires
--------------------------
Sommaire :
1/ Le fonctionnement des formulaires
2/ Générer les formulaires (Class type)
3/ Récupérer les données du formulaire
4/ Personnaliser un formulaire avec bootstrap
5/ Update d'un enregistrement
6/ Validation des données
7/ Champs file
--------------
1/ Le fonctionnement des formulaires

	De la même manière qu'on ne manipule aps des enregistrement en BDD, mais bien des objets (Entity), chaque formulaires va être lié à une entité.

	Ainsi, un formulaire sera toujours lié à un objet...

	inscription --> Entity Membre
	ajout de produit --> Entity Produit
	modif de produit --> Entity Produit

	Un formulaire va correspondre à une class MembreType, ProduitType...

	Chaque champs du formulaire va correspondre à une classe... TextareaType (génère un champs textarea, mais egalement toutes les phases de vérif/controle de ce champs...)

2/ Générer les formulaires (Class type)

	<cmd>
	php bin/console generate:doctrine:form AppBundle:Produit

3/ Récupérer les données du formulaire

    - Générer le form :
    $produit = new $Produit;
    $form = $this -> createForm(ShoesType::class, $produit);

    - Générer la vue d'un formulaire :
    $form -> createView();

    - Pour récupérer les données d'un formulaire, il faut dans un premier lier directement l'objet et le formulaire (hydatation)

    <code>
    $form -> handleRequest($request)

    /!\ On oublie pas de use Request en haut de page, et de récupérer l'objet request dans les arguments de la fonction.


    - On check si le formulaire est soumis et est valide
    <code>
    if($form -> isSubmitted() && $form -> isValid())

    - On enregistre les infos en BDD
    <code>
    $em = $this -> getDoctrine() -> getManager();
    $em -> persist($shoes);
    $em -> flush();


4/ Personnaliser le formulaire avec bootstrap

  - cf Admin/Produit/add/ Admin/produit_form.html.twig

  - Par défaut on peut mettre en forme tous les formulaires via bootstrap, en modifiant le fichier app/config/config.yml
  <code>
  twig:
      form_themes:
        - 'bootstrap_4_layout.html.twig'



5/ Update un Enregistrement

    - Pour update un enregistrement c'est comme créer un enregistrement sauf que le formulaire est lié à un objet existant et non à un objet vide.


6/ Validation des données


    -> Voir les Constraints dans notre ProduitType.

7/ Champs file



===> Pour aller plus loin avec les formulaires symfony : Lien : https://symfony.com/doc/current/reference/forms/types.html
