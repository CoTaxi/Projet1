<?php

namespace TaxiCoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity
 */
/**
 * Service
 *
 * @ORM\Table(name="Service")
 * @ORM\Entity(repositoryClass="TaxiCoBundle\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_service", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;



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
     * Set name
     *
     * @param string $name
     *
     * @return Service
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
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name;
    }
}
