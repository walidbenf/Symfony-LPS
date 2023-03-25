<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends Controller
{
	// inscription, connexion, profil, deconnexion, modifier, supprimer

	/**
	* @Route("/inscription/", name="inscription")
	*
	*/
	public function inscriptionAction(){
        $params = array();
		return $this -> render('@App/Membre/inscription.html.twig', $params);
	}
	
	/**
	* @Route("/connexion/", name="connexion")
	*
	*/
	public function connexionAction(){	
        $params = array();
		return $this -> render('@App/Membre/connexion.html.twig', $params);
	}
	
	/**
	* @Route("/profil/", name="profil")
	*
	*/
	public function profilAction(){	
        $params = array();
		return $this -> render('@App/Membre/profil.html.twig', $params);
	}
}


