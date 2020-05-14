<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rdv
 *
 * @ORM\Table(name="rdv", indexes={@ORM\Index(name="IDX_10C31F863F0033A2", columns={"id_service"}), @ORM\Index(name="IDX_10C31F86B911D4E6", columns={"id_garage"})})
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
    private $idChauffeur = 'NULL';

    /**

     * @var \DateTime
     *
     * @ORM\Column(name="date_rdv", type="date", nullable=true)

     * @var String
     *
     * @ORM\Column(name="date_rdv", type="string", nullable=true)

     */
    private $dateRdv = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status = 'NULL';

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_service", referencedColumnName="id_service")
     * })
     */
    private $idService;

    /**
     * @var \Garage
     *
     * @ORM\ManyToOne(targetEntity="Garage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_garage", referencedColumnName="id_garage")
     * })
     */
    private $idGarage;

    /**
     * @return int
     */
    public function getIdRdv()
    {
        return $this->idRdv;
    }

    /**
     * @param int $idRdv
     */
    public function setIdRdv($idRdv)
    {
        $this->idRdv = $idRdv;
    }

    /**
     * @return int
     */
    public function getIdChauffeur()
    {
        return $this->idChauffeur;
    }

    /**
     * @param int $idChauffeur
     */
    public function setIdChauffeur($idChauffeur)
    {
        $this->idChauffeur = $idChauffeur;
    }

    /**

     * @return \DateTime

     * @return String

     */
    public function getDateRdv()
    {
        return $this->dateRdv;
    }

    /**

     * @param \DateTime $dateRdv

     * @param String $dateRdv

     */
    public function setDateRdv($dateRdv)
    {
        $this->dateRdv = $dateRdv;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \Service
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * @param \Service $idService
     */
    public function setIdService($idService)
    {
        $this->idService = $idService;
    }

    /**
     * @return \Garage
     */
    public function getIdGarage()
    {
        return $this->idGarage;
    }

    /**
     * @param \Garage $idGarage
     */
    public function setIdGarage($idGarage)
    {
        $this->idGarage = $idGarage;
    }


}

