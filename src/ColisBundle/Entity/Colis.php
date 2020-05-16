<?php

namespace ColisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Colis
 *
 * @ORM\Table(name="colis", indexes={@ORM\Index(name="ckcolis", columns={"nomcategorie"})})
 * @ORM\Entity(repositoryClass="ColisBundle\Repository\ColisRepository")
 */
class Colis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_c", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idC;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=250, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=250, nullable=false)
     */
    private $destination;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_expediteur", type="string", length=250, nullable=false)
     */
    private $nomExpediteur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_destinataire", type="string", length=250, nullable=false)
     */
    private $nomDestinataire;

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float", precision=10, scale=0, nullable=false)
     */
    private $poids;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_karhba", type="integer", nullable=true)
     */
    private $idKarhba;

    /**
     * @var integer
     *
     * @ORM\Column(name="tel_destinataire", type="integer", nullable=false)
     ** @Assert\Length(min=8)
     */
    private $telDestinataire;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_expediteur", type="string", length=250, nullable=false)
     */
    private $mailExpediteur;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_destinataire", type="string", length=250, nullable=true)
     * * @Assert\Email
     */
    private $mailDestinataire;

    /**
     * @var string
     *
     * @ORM\Column(name="pickup", type="text", nullable=true)
     */
    private $pickup;
    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nomcategorie", referencedColumnName="idcatergory")
     * })
     */
    private $nomcategorie;
    /**
     * @var integer
     *
     * @ORM\Column(name="id_expediteur", type="integer", nullable=true)
     */
    private $idExpediteur;

    /**
     * @return int
     */
    public function getIdExpediteur()
    {
        return $this->idExpediteur;
    }

    /**
     * @param int $idExpediteur
     */
    public function setIdExpediteur($idExpediteur)
    {
        $this->idExpediteur = $idExpediteur;
    }


    /**
     * Get idC
     *
     * @return integer
     */
    public function getIdC()
    {
        return $this->idC;
    }

    /**
     * Set depart
     *
     * @param string $depart
     *
     * @return Colis
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return Colis
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
     * Set nomExpediteur
     *
     * @param string $nomExpediteur
     *
     * @return Colis
     */
    public function setNomExpediteur($nomExpediteur)
    {
        $this->nomExpediteur = $nomExpediteur;

        return $this;
    }

    /**
     * Get nomExpediteur
     *
     * @return string
     */
    public function getNomExpediteur()
    {
        return $this->nomExpediteur;
    }

    /**
     * Set nomDestinataire
     *
     * @param string $nomDestinataire
     *
     * @return Colis
     */
    public function setNomDestinataire($nomDestinataire)
    {
        $this->nomDestinataire = $nomDestinataire;

        return $this;
    }

    /**
     * Get nomDestinataire
     *
     * @return string
     */
    public function getNomDestinataire()
    {
        return $this->nomDestinataire;
    }

    /**
     * Set poids
     *
     * @param float $poids
     *
     * @return Colis
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return float
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Colis
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
     * Set idKarhba
     *
     * @param integer $idKarhba
     *
     * @return Colis
     */
    public function setIdKarhba($idKarhba)
    {
        $this->idKarhba = $idKarhba;

        return $this;
    }

    /**
     * Get idKarhba
     *
     * @return integer
     */
    public function getIdKarhba()
    {
        return $this->idKarhba;
    }

    /**
     * Set telDestinataire
     *
     * @param integer $telDestinataire
     *
     * @return Colis
     */
    public function setTelDestinataire($telDestinataire)
    {
        $this->telDestinataire = $telDestinataire;

        return $this;
    }

    /**
     * Get telDestinataire
     *
     * @return integer
     */
    public function getTelDestinataire()
    {
        return $this->telDestinataire;
    }

    /**
     * Set mailExpediteur
     *
     * @param string $mailExpediteur
     *
     * @return Colis
     */
    public function setMailExpediteur($mailExpediteur)
    {
        $this->mailExpediteur = $mailExpediteur;

        return $this;
    }

    /**
     * Get mailExpediteur
     *
     * @return string
     */
    public function getMailExpediteur()
    {
        return $this->mailExpediteur;
    }

    /**
     * Set mailDestinataire
     *
     * @param string $mailDestinataire
     *
     * @return Colis
     */
    public function setMailDestinataire($mailDestinataire)
    {
        $this->mailDestinataire = $mailDestinataire;

        return $this;
    }

    /**
     * Get mailDestinataire
     *
     * @return string
     */
    public function getMailDestinataire()
    {
        return $this->mailDestinataire;
    }

    /**
     * Set nomcategorie
     *
     * @param \ColisBundle\Entity\Category $nomcategorie
     *
     * @return Colis
     */
    public function setNomcategorie(\ColisBundle\Entity\Category $nomcategorie = null)
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }

    /**
     * Get nomcategorie
     *
     * @return \ColisBundle\Entity\Category
     */
    public function getNomcategorie()
    {
        return $this->nomcategorie;
    }


    public function __toString()
    {
     return $this->nomcategorie ;

    }

    /**
     * @return string
     */
    public function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @param string $pickup
     */
    public function setPickup($pickup)
    {
        $this->pickup = $pickup;
    }

}
