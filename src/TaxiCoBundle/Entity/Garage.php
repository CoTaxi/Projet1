<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Garage
 *
 * @ORM\Table(name="garage", indexes={@ORM\Index(name="IDX_9F26610B3F0033A2", columns={"id_service"})})
 * @ORM\Entity
 */
class Garage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_garage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGarage;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=true)
     */
    private $address = 'NULL';

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
     * @return int
     */
    public function getIdGarage()
    {
        return $this->idGarage;
    }

    /**
     * @param int $idGarage
     */
    public function setIdGarage($idGarage)
    {
        $this->idGarage = $idGarage;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
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


}

