<?php

namespace TaxiCoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Garage
 *
 * @ORM\Table(name="garage", indexes={@ORM\Index(name="id_service_fk", columns={"id_service"})})
 * @ORM\Entity
 */

/**
 * Garage
 *
 * @ORM\Table(name="garage")
 * @ORM\Entity(repositoryClass="TaxiCoBundle\Repository\GarageRepository")
 */
class Garage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_garage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idGarage;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=true)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_service", type="integer", nullable=true)
     */
    private $idService;

//    /**
//     * @ORM\ManyToMany(targetEntity="TaxiCoBundle\Entity\Service", cascade={"persist"})
//     * @ORM\JoinTable(name="garage_service",
//     *  joinColumns={@ORM\JoinColumn(name="id_garage" ,referencedColumnName="id_garage")},
//     *     inverseJoinColumns={@ORM\JoinColumn(name="id_service", referencedColumnName="id_service")})
//     */
//    private $service;


    /**
     * @ORM\ManyToOne(targetEntity="TaxiCoBundle\Entity\Service")
     * @ORM\JoinColumn(name="id_service",referencedColumnName="id_service")
     * @Assert\NotBlank()
     */
    private $service;

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
     * Get idGarage
     *
     * @return integer
     */
    public function getIdGarage()
    {
        return $this->idGarage;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Garage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Garage
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set idService
     *
     * @param integer $idService
     *
     * @return Garage
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
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name;
    }
}
