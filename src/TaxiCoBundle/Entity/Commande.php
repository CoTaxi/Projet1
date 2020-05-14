<?php


namespace TaxiCoBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="TaxiCoBundle\Repository\CommandeRepository")
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
     * @ORM\Column(name="pt_depart", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *     message="This field cannot be blank"
     * )
     *
     */
    private $ptDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="pt_arrivee", type="string", length=250, nullable=false)
     * @Assert\NotBlank(
     *     message="This field cannot be blank"
     * )
     *
     */
    private $ptArrivee;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="mode_paiement", type="string", length=260, nullable=false)
     */
    private $modepaiement;

    /**
     * @var \string
     *
     * @ORM\Column(name="date", type="string", nullable=false)
     *
     */
    private $date;

    /**
     * @var \string
     *
     * @ORM\Column(name="time", type="string", nullable=false)
     */
    private $time;
    /**
     * @var integer
     *
     * @ORM\Column(name="client", type="integer", nullable=true)
     */
    private $client;
    /**
     * @var integer
     *
     * @ORM\Column(name="vehicule", type="integer", nullable=true)
     */
    private $vehicule;
    /**
     * @var \string
     *
     * @ORM\Column(name="typecmd", type="string", nullable=true)
     *
     */
    private $typecmd;
    /**
     * @var integer
     *
     * @ORM\Column(name="idcolis", type="integer", nullable=true)
     */
    private $idcolis;

    /**
     * @return int
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * @return string
     */
    public function getPtDepart()
    {
        return $this->ptDepart;
    }

    /**
     * @param string $ptDepart
     */
    public function setPtDepart($ptDepart)
    {
        $this->ptDepart = $ptDepart;
    }

    /**
     * @return string
     */
    public function getPtArrivee()
    {
        return $this->ptArrivee;
    }

    /**
     * @param string $ptArrivee
     */
    public function setPtArrivee($ptArrivee)
    {
        $this->ptArrivee = $ptArrivee;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getModepaiement()
    {
        return $this->modepaiement;
    }

    /**
     * @param string $modepaiement
     */
    public function setModepaiement($modepaiement)
    {
        $this->modepaiement = $modepaiement;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param int $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return int
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * @param int $vehicule
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;
    }

    /**
     * @return string
     */
    public function getTypecmd()
    {
        return $this->typecmd;
    }

    /**
     * @param string $typecmd
     */
    public function setTypecmd($typecmd)
    {
        $this->typecmd = $typecmd;
    }

    /**
     * @return int
     */
    public function getIdcolis()
    {
        return $this->idcolis;
    }

    /**
     * @param int $idcolis
     */
    public function setIdcolis($idcolis)
    {
        $this->idcolis = $idcolis;
    }

}