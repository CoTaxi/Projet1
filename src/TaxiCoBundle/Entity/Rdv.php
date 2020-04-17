<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Rdv
 *
 * @ORM\Table(name="rdv", indexes={@ORM\Index(name="id_chauffeur_fk", columns={"id_chauffeur"}), @ORM\Index(name="id_garage_fk", columns={"id_garage"}), @ORM\Index(name="id_service_fk", columns={"id_service"})})
 * @ORM\Entity
 */

/**
 * Rdv
 *
 * @ORM\Table(name="rdv")
 * @ORM\Entity(repositoryClass="TaxiCoBundle\Repository\RdvRepository")
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
     * @var String
     *
     * @ORM\Column(name="date_rdv", type="string", nullable=true)
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

//    /**
//     * @ORM\ManyToOne(targetEntity="TaxiCoBundle\Entity\Garage")
//     * @ORM\JoinColumn(name="id_Garage",referencedColumnName="idGarage")
//     */
//    private $id_garage;


    /**
     * @ORM\ManyToOne(targetEntity="TaxiCoBundle\Entity\Service")
     * @ORM\JoinColumn(name="id_service",referencedColumnName="id_service")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="TaxiCoBundle\Entity\Garage")
     * @ORM\JoinColumn(name="id_garage",referencedColumnName="id_garage")
     */
    private $garage;
//    public function __construct()
//    {
//        $this->service = new ArrayCollection();
//    }

    /**
     * @return mixed
     */
    public function getGarage()
    {
        return $this->garage;
    }

    /**
     * @param mixed $garage
     */
    public function setGarage($garage)
    {
        $this->garage = $garage;
    }

//    /**
//     * @return mixed
//     */
//    public function getService()
//    {
//        return $this->service;
//    }
//
//    /**
//     * @param mixed $service
//     */
//    public function setService($service)
//    {
//        $this->service = $service;
//    }

//    /**
//     * @ORM\ManyToMany(targetEntity="TaxiCoBundle\Entity\Service", cascade={"persist"})
//     * @ORM\JoinTable(name="rdv_service",
//     *  joinColumns={@ORM\JoinColumn(name="id_rdv" ,referencedColumnName="id_rdv")},
//     *     inverseJoinColumns={@ORM\JoinColumn(name="id_service", referencedColumnName="id_service")})
//     */
//    private $service;

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }



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
     * @return String
     */
    public function getDateRdv()
    {
        return $this->dateRdv;
    }

    /**
     * @param String $dateRdv
     */
    public function setDateRdv($dateRdv)
    {
        $this->dateRdv = $dateRdv;
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
//    public function __toString()
//    {
//        // TODO: Implement __toString() method.
//        return $this->name;
//    }
}
