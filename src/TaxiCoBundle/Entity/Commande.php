<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="clientk", columns={"client"}), @ORM\Index(name="karhba", columns={"vehicule"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_commande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="pt_depart", type="string", length=250, nullable=false)
     */
    private $ptDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="pt_arrivee", type="string", length=250, nullable=false)
     */
    private $ptArrivee;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="type_paiement", type="string", length=250, nullable=false)
     */
    private $typePaiement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", nullable=false)
     */
    private $time;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="id_u")
     * })
     */
    private $client;

    /**
     * @var \Vehicule
     *
     * @ORM\ManyToOne(targetEntity="Vehicule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicule", referencedColumnName="id_v")
     * })
     */
    private $vehicule;



    /**
     * Get idCommande
     *
     * @return integer
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set ptDepart
     *
     * @param string $ptDepart
     *
     * @return Commande
     */
    public function setPtDepart($ptDepart)
    {
        $this->ptDepart = $ptDepart;

        return $this;
    }

    /**
     * Get ptDepart
     *
     * @return string
     */
    public function getPtDepart()
    {
        return $this->ptDepart;
    }

    /**
     * Set ptArrivee
     *
     * @param string $ptArrivee
     *
     * @return Commande
     */
    public function setPtArrivee($ptArrivee)
    {
        $this->ptArrivee = $ptArrivee;

        return $this;
    }

    /**
     * Get ptArrivee
     *
     * @return string
     */
    public function getPtArrivee()
    {
        return $this->ptArrivee;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Commande
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
     * Set typePaiement
     *
     * @param string $typePaiement
     *
     * @return Commande
     */
    public function setTypePaiement($typePaiement)
    {
        $this->typePaiement = $typePaiement;

        return $this;
    }

    /**
     * Get typePaiement
     *
     * @return string
     */
    public function getTypePaiement()
    {
        return $this->typePaiement;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Commande
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set client
     *
     * @param \TaxiCoBundle\Entity\User $client
     *
     * @return Commande
     */
    public function setClient(\TaxiCoBundle\Entity\User $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \TaxiCoBundle\Entity\User
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set vehicule
     *
     * @param \TaxiCoBundle\Entity\Vehicule $vehicule
     *
     * @return Commande
     */
    public function setVehicule(\TaxiCoBundle\Entity\Vehicule $vehicule = null)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return \TaxiCoBundle\Entity\Vehicule
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }
}
