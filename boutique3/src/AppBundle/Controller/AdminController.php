<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Commande;
use AppBundle\Entity\Membre;

use AppBundle\Form\ProduitType;

class AdminController extends Controller
{
	/**
	* @Route("/admin/produit/", name="produit_list")
	*
	*/
	public function produitAction(){

		$repository = $this -> getDoctrine() -> getRepository(Produit::class);

		$produits = $repository -> findAll();


		$params = array(
			'produits' => $produits
		);

		return $this -> render("@App/Admin/produit_list.html.twig", $params);
	}


	/**
	* @Route("/admin/produit/add/", name="produit_add")
	*
	*/
	public function produitAddAction(Request $request){

		$produit = new Produit;
		// Objet vide de l'Entity Produit

		$form = $this -> createForm(ProduitType::class, $produit);

		$form -> handleRequest($request);
		// Cette ligne est importante, elle permet de récupérer les infos en POST et donc de lier définitivement $produit aux données saisies dans le formulaire.


		if($form -> isSubmitted() && $form -> isValid()){
			$em = $this -> getDoctrine() -> getManager();

			$em -> persist($produit);
			$produit -> uploadPhoto();
			$em -> flush();

			return $this -> redirectToRoute('produit_list');

			// test : localhost:8000/admin/produit/add
			// test : localhost:8000
		}

		$params = array(
			'produitForm' => $form -> createView()
		);
		return $this -> render("@App/Admin/produit_form.html.twig", $params);
	}





	/**
	* @Route("/admin/produit/update/{id}/", name="produit_update")
	*
	*/
	public function produitUpdateAction($id, Request $request){

		$em = $this -> getDoctrine() -> getManager();

		$produit = $em -> find(Produit::class, $id);

		$form = $this -> createForm(ProduitType::class, $produit);
		$form -> handleRequest($request);

		if($form -> isSubmitted() && $form -> isValid()){
			$em -> persist($produit);
			$produit -> uploadPhoto();
			$em -> flush();

			$request -> getSession() -> getFlashBag() -> add('success', 'Le produit id' . $id . ' a bien été modifié');

			return $this -> redirectToRoute('produit_list');
		}

		$params = array(
			'produitForm' => $form -> createView()
		);
		return $this -> render('@App/Admin/produit_form.html.twig', $params);
	}











	/**
	* @Route("/admin/produit/delete/{id}/", name="produit_delete")
	*
	*/
	public function produitDeleteAction($id, Request $request){
		$em = $this -> getDoctrine() -> getManager();

		//1 : On récupère l'objet
		$produit = $em -> find(Produit::class, $id);

		if($produit){
			//2 : Suppression :
			$em -> remove($produit);
			$em -> flush();
			// Test : localhost:8000/admin/produit/delete/16
			// localhost:8000


			$session = $request -> getSession();
			$session -> getFlashBag() -> add('success', 'Le produit ' . $id . ' a bien été supprimé');
		}
		else{
			$session = $request -> getSession();
			$session -> getFlashBag() -> add('errors', 'Le produit ' . $id . ' n\' pas été supprimé car il existe pas');
		}

		return $this -> redirectToRoute('produit_list');
	}


	/**
	* @Route("/admin/membre/", name="membre_list")
	*
	*/
	public function membreAction(){
		$params = array();
		return $this -> render("@App/Admin/membre_list.html.twig", $params);
	}


	/**
	* @Route("/admin/membre/add/", name="membre_add")
	*
	*/
	public function membreAddAction(){
		$params = array();
		return $this -> render("@App/Admin/membre_form.html.twig", $params);
	}

	/**
	* @Route("/admin/membre/update/{id}/", name="membre_update")
	*
	*/
	public function membreUpdateAction(){
		$params = array();
		return $this -> render("@App/Admin/membre_form.html.twig", $params);
	}

	/**
	* @Route("/admin/membre/delete/{id}/", name="membre_delete")
	*
	*/
	public function membreDeleteAction($id, Request $request){
		$session = $request -> getSession();
		$session -> getFlashBag() -> add('success', 'Le membre ' . $id . ' a bien été supprimé');

		return $this -> redirectToRoute('membre_list');
	}



	/**
	* @Route("/admin/commande/", name="commande_list")
	*
	*/
	public function commandeAction(){
		$params = array();
		return $this -> render("@App/Admin/commande_list.html.twig", $params);
	}


	/**
	* @Route("/admin/commande/add/", name="commande_add")
	*
	*/
	public function commandeAddAction(){
		$params = array();
		return $this -> render("@App/Admin/commande_form.html.twig", $params);
	}

	/**
	* @Route("/admin/commande/update/{id}/", name="commande_update")
	*
	*/
	public function commandeUpdateAction(){
		$params = array();
		return $this -> render("@App/Admin/commande_form.html.twig", $params);
	}

	/**
	* @Route("/admin/commande/delete/{id}/", name="commande_delete")
	*
	*/
	public function commandeDeleteAction($id, Request $request){
		$session = $request -> getSession();
		$session -> getFlashBag() -> add('success', 'La commande ' . $id . ' a bien été supprimée');

		return $this -> redirectToRoute('commande_list');
	}




}
