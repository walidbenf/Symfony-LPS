<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=15, nullable=false)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=50, nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=15, nullable=false)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="string", length=3, nullable=false)
     */
    private $taille;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=5, nullable=false)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;




    private $file;
    // Cette propriété n'est pas mappé, parce que ne correspond à rien dans la bdd . Cette propiété va simplement nous permettre de mainpuler la data (photo physique).
    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;





    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Produit
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Produit
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Produit
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Produit
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set taille
     *
     * @param string $taille
     *
     * @return Produit
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return string
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Produit
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Produit
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Produit
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }
    public function getFile(){
      return $this->file;
    }

    public function setFile(UploadedFile $file = NULL){
      $this ->file = $file;
      return $this;
    }

    //Fonction pour traiter l'upload
    public function uploadPhoto(){
      //Si il n' y a pas de photos chargées (update d'un produit)
      //Alors on sort de la fonction.
      if(!$this->file){
        return;
      }
    //récupérer le nom original (short.jpg) et de la renommer (photo_1500000_2367_chat.jpg)
    $name= $this->file->getClientOriginalName();
    $new_name = $this->renameFile($name);

    //enregistrer le nouveau nom en BDD (private $photo)
    $this->photo =$new_name;

    //Copier/coller la photo à l'endroit attendu (src/web/photo/photo_1500000_2367_chat.jpg)
    $this->file->move($this->dirPhoto(),$newname);

    }


    //Fonction pour renommer un fichier
    public function renameFile(){
      return 'photo_' . time() . '_' . rand(1, 9999) . '_' .$nom;
      //short.jpg
      //return 'photo_1500000_2367_chat.jpg'
    }

    //Fonction qui retourne le chemin du dossier photo
    public function dirPhoto(){
      return __DIR__ . '/../../../web/photo';

    }

    //Fonction pour supprimer une photo
    public function removePhoto(){
      if (!file_exists($this->dirPhoto() . '/'. $this->photo)){
        return;
      }
      unlink($this->dirPhoto() . '/' . $this->photo);
      //unlink = supprime un fichier sur le serveur
    }
}
