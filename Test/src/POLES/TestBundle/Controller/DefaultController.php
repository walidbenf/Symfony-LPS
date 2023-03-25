<?php

namespace POLES\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction()
    {
        //return $this->render('POLESTestBundle:Default:index.html.twig');
        return $this->render('@POLESTest/Default/index.html.twig');
    }
    /**
    *@Route("/bonjour/")
    *localhost:8000/bonjour/
    */
    public function bonjourAction() {
      echo 'Bonjour';
    }

    /**
    *@Route("/bonjour2/")
    *
    */
    public function bonjour2Action() {
      return new Response("<h1>Bonjour 2</h1>");
}
/**
*@Route("/hello/{prenom}/")
*
*/
  public function helloAction($prenom) {
    return new Response('Bonjour' . $prenom . ' !');
}
  //test : localhost:8000/hello/Yakine
  //test : localhost:8000/hello/Valérie

/**
*@Route("/hola/{prenom}/")
*
*/
public function holaAction($prenom) {

  $params = array(
    'prenom' => $prenom
  );

  $ths->render('@POLESTest/Default/hola.html.twig',$params);
}
/**
*@Route("/ciao/{prenom}/{age}")
*
*/
public function ciaoAction($prenom,$age) {
  $params =array(
    'prenom' =>$prenom,
  'age' => $age
);

return $this->render('POLESTest/Default/ciao.html.twig',$params);
}

/**
*@Route("/redirect/")
*
*/
public function redirectAction() {
  $route = $this->get('router') -> generate('accueil');
  return new RedirectResponse($route);
}
//Test : localhost:8000/redirect/

/**
*@Route("/redirect2/")
*
*/
public function redirect2Action(){
  $this->redirectToRoute('accueil');
}
//Test : localhost:8000/redirect2/

/**
*@Route('/message/', name="message")
*
*/
public function messageAction(Request $request) {
  $session = $request->getSession()
  $session->getFlashBag()->add('success', 'Félicitations vous êtes enregistrer');
  $session->getFlashBag()->add('errors', 'Le produit n\'a pas été supprimé');

  return $this->redirectToRoute('accueil');

}
}
