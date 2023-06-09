<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Produit;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends \Doctrine\ORM\EntityRepository
{
	// Query Builder
	public function getAllCategories(){
		$em = $this -> getEntityManager();
		$query = $em -> createQueryBuilder();

		$query 
		-> select('p.categorie') 
		-> distinct(true)
		-> from(Produit::class, 'p') 
		-> OrderBy('p.categorie', 'ASC'); 
		
		return $query -> getQuery() -> getResult();
	}
	
	
	// Create Query : 
	public function getAllCategories2(){
		
		$em = $this -> getEntityManager();

		$query = $em -> createQuery("SELECT DISTINCT(p.categorie) FROM AppBundle\Entity\Produit p ORDER BY p.categorie");
		$tab  = $query -> getResult(); 
		// array numérique
		
		$categories = array();
		foreach($tab as $key => $value){
			$categories[] = array('categorie' => $value[1]);
		}
		// array associatif
		
		return $categories;
	}
	
	
}
