<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_v", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=250, nullable=false)
     */
    private $matricule;


    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=250, nullable=false)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=250, nullable=false)
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="cartegrise", type="string", length=250, nullable=false)
     */
    private $cartegrise;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=250, nullable=false)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=250, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="dispo", type="integer", nullable=false)
     */
    private $dispo;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=250, nullable=false)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=250, nullable=false)
     */
    private $destination;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var integer
     *
     * @ORM\Column(name="places", type="integer", nullable=false)
     */
    private $places = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dateco", type="string", length=250, nullable=true)
     */
    private $dateco;

    /**
     * @var integer
     *
     * @ORM\Column(name="archive", type="integer", nullable=true)
     */
    private $archive;

    /**
     * @var string
     *
     * @ORM\Column(name="zone", type="string", length=250, nullable=true)
     */
    private $zone;

    /**
     * @var string
     *
     * @ORM\Column(name="accept_c", type="string", length=255, nullable=true)
     */
    private $acceptC = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="user", type="integer", nullable=true)
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="poidsmax", type="integer", nullable=true)
     */
    private $poidsmax;
    /**
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Vehicule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Vehicule
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Vehicule
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set cartegrise
     *
     * @param string $cartegrise
     *
     * @return Vehicule
     */
    public function setCartegrise($cartegrise)
    {
        $this->cartegrise = $cartegrise;

        return $this;
    }

    /**
     * Get cartegrise
     *
     * @return string
     */
    public function getCartegrise()
    {
        return $this->cartegrise;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Vehicule
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
     * Set type
     *
     * @param string $type
     *
     * @return Vehicule
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dispo
     *
     * @param integer $dispo
     *
     * @return Vehicule
     */
    public function setDispo($dispo)
    {
        $this->dispo = $dispo;

        return $this;
    }

    /**
     * Get dispo
     *
     * @return integer
     */
    public function getDispo()
    {
        return $this->dispo;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Vehicule
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return Vehicule
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Vehicule
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set places
     *
     * @param integer $places
     *
     * @return Vehicule
     */
    public function setPlaces($places)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return integer
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set dateco
     *
     * @param string $dateco
     *
     * @return Vehicule
     */
    public function setDateco($dateco)
    {
        $this->dateco = $dateco;

        return $this;
    }

    /**
     * Get dateco
     *
     * @return string
     */
    public function getDateco()
    {
        return $this->dateco;
    }

    /**
     * Set archive
     *
     * @param integer $archive
     *
     * @return Vehicule
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return integer
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set zone
     *
     * @param string $zone
     *
     * @return Vehicule
     */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set acceptC
     *
     * @param string $acceptC
     *
     * @return Vehicule
     */
    public function setAcceptC($acceptC)
    {
        $this->acceptC = $acceptC;

        return $this;
    }

    /**
     * Get acceptC
     *
     * @return string
     */
    public function getAcceptC()
    {
        return $this->acceptC;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getPoidsmax()
    {
        return $this->poidsmax;
    }

    /**
     * @param int $poidsmax
     */
    public function setPoidsmax($poidsmax)
    {
        $this->poidsmax = $poidsmax;
    }


}
