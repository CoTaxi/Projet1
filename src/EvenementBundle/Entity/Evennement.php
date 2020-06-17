<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Evennement
 *
 * @ORM\Table(name="evennement")
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\EvenementRepository")
 */
class Evennement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=250, nullable=false)
     *
     * * @Assert\NotBlank
     * * @Assert\Length(min=5)
     */
    private $nomEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_event", type="datetime", nullable=false)
     * * @Assert\DateTime
     *
     * * @Assert\NotBlank
     */
    private $dateEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_event_fin", type="datetime", nullable=false)
     * * @Assert\DateTime
     */
    private $dateEventFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_event", type="integer", nullable=false)
     *
     * * @Assert\NotBlank
     * * @Assert\length(max=7)
     */
    private $dureeEvent;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacite", type="integer", nullable=false)
     *
     * * @Assert\NotBlank
     */
    private $capacite;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacement", type="string", length=50, nullable=false)
     *
     * * @Assert\NotBlank
     */
    private $emplacement;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=250, nullable=false)
     */
    private $etat;

    /**
     * @var integer
     *
     * @ORM\Column(name="place", type="integer", nullable=true)
     *
     */
    private $place;




    /**
     * Get idEvent
     *
     * @return integer
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * Set nomEvent
     *
     * @param string $nomEvent
     *
     * @return Evennement
     */
    public function setNomEvent($nomEvent)
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    /**
     * Get nomEvent
     *
     * @return string
     */
    public function getNomEvent()
    {
        return $this->nomEvent;
    }

    /**
     * Set dateEvent
     *
     * @param \DateTime $dateEvent
     *
     * @return Evennement
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get dateEvent
     *
     * @return \DateTime
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * Set dateEventFin
     *
     * @param \DateTime $dateEventFin
     *
     * @return Evennement
     */
    public function setDateEventFin($dateEventFin)
    {
        $this->dateEventFin = $dateEventFin;

        return $this;
    }

    /**
     * Get dateEventFin
     *
     * @return \DateTime
     */
    public function getDateEventFin()
    {
        return $this->dateEventFin;
    }

    /**
     * Set dureeEvent
     *
     * @param integer $dureeEvent
     *
     * @return Evennement
     */
    public function setDureeEvent($dureeEvent)
    {
        $this->dureeEvent = $dureeEvent;

        return $this;
    }

    /**
     * Get dureeEvent
     *
     * @return integer
     */
    public function getDureeEvent()
    {
        return $this->dureeEvent;
    }

    /**
     * Set capacite
     *
     * @param integer $capacite
     *
     * @return Evennement
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return integer
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set emplacement
     *
     * @param string $emplacement
     *
     * @return Evennement
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return string
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Evennement
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @return int
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param int $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

}
