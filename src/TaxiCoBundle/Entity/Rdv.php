<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rdv
 *
 * @ORM\Table(name="rdv", indexes={@ORM\Index(name="id_chauffeur_fk", columns={"id_chauffeur"}), @ORM\Index(name="id_garage_fk", columns={"id_garage"}), @ORM\Index(name="id_service_fk", columns={"id_service"})})
 * @ORM\Entity
 */
class Rdv
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_rdv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRdv;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_chauffeur", type="integer", nullable=true)
     */
    private $idChauffeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rdv", type="date", nullable=true)
     */
    private $dateRdv;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_garage", type="integer", nullable=true)
     */
    private $idGarage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_service", type="integer", nullable=true)
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;



    /**
     * Get idRdv
     *
     * @return integer
     */
    public function getIdRdv()
    {
        return $this->idRdv;
    }

    /**
     * Set idChauffeur
     *
     * @param integer $idChauffeur
     *
     * @return Rdv
     */
    public function setIdChauffeur($idChauffeur)
    {
        $this->idChauffeur = $idChauffeur;

        return $this;
    }

    /**
     * Get idChauffeur
     *
     * @return integer
     */
    public function getIdChauffeur()
    {
        return $this->idChauffeur;
    }

    /**
     * Set dateRdv
     *
     * @param \DateTime $dateRdv
     *
     * @return Rdv
     */
    public function setDateRdv($dateRdv)
    {
        $this->dateRdv = $dateRdv;

        return $this;
    }

    /**
     * Get dateRdv
     *
     * @return \DateTime
     */
    public function getDateRdv()
    {
        return $this->dateRdv;
    }

    /**
     * Set idGarage
     *
     * @param integer $idGarage
     *
     * @return Rdv
     */
    public function setIdGarage($idGarage)
    {
        $this->idGarage = $idGarage;

        return $this;
    }

    /**
     * Get idGarage
     *
     * @return integer
     */
    public function getIdGarage()
    {
        return $this->idGarage;
    }

    /**
     * Set idService
     *
     * @param integer $idService
     *
     * @return Rdv
     */
    public function setIdService($idService)
    {
        $this->idService = $idService;

        return $this;
    }

    /**
     * Get idService
     *
     * @return integer
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Rdv
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
