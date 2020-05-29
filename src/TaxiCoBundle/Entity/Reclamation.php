<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="fkuser", columns={"idch"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_r", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idR;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=250, nullable=false)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rec", type="datetime", nullable=false)
     */
    private $dateRec;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="text", length=65535, nullable=false)
     */
    private $reponse;

    /**
     * @var string
     *
     * @ORM\Column(name="Chauffeur", type="text", length=65535, nullable=false)
     */
    private $chauff;

    /**
     * @return string
     */
    public function getChauff()
    {
        return $this->chauff;
    }

    /**
     * @param string $chauff
     */
    public function setChauff($chauff)
    {
        $this->chauff = $chauff;
    }

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idch", referencedColumnName="id_u")
     * })
     */
    private $idch;

    /**
     * @var \typereclamation
     *
     * @ORM\ManyToOne(targetEntity="typereclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     * })
     */
    private $Objet;


    /**
     * @return \typereclamation
     */
    public function getObjet()
    {
        return $this->Objet;
    }

    /**
     * @param \typereclamation $Objet
     */
    public function setObjet($Objet)
    {
        $this->Objet = $Objet;
    }


    /**
     * Get idR
     *
     * @return integer
     */
    public function getIdR()
    {
        return $this->idR;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Reclamation
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Reclamation
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
     * Set dateRec
     *
     * @param \DateTime $dateRec
     *
     * @return Reclamation
     */
    public function setDateRec($dateRec)
    {
        $this->dateRec = $dateRec;

        return $this;
    }

    /**
     * Get dateRec
     *
     * @return \DateTime
     */
    public function getDateRec()
    {
        return $this->dateRec;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Reclamation
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set idch
     *
     * @param \TaxiCoBundle\Entity\User $idch
     *
     * @return Reclamation
     */
    public function setIdch(\TaxiCoBundle\Entity\User $idch)
    {
        $this->idch = $idch;

        return $this;
    }

    /**
     * Get idch
     *
     * @return \TaxiCoBundle\Entity\User
     */
    public function getIdch()
    {
        return $this->idch;
    }



}
