<?php

namespace ContratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat", indexes={@ORM\Index(name="chiffour", columns={"id_chauff"})})
 * @ORM\Entity
 */
class Contrat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_contrat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContrat;

    /**
     * @var string
     *
     * @ORM\Column(name="type_c", type="string", length=250, nullable=false)
     */
    private $typeC;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_chauff", referencedColumnName="id_u")
     * })
     */
    private $idChauff;



    /**
     * Get idContrat
     *
     * @return integer
     */
    public function getIdContrat()
    {
        return $this->idContrat;
    }

    /**
     * Set typeC
     *
     * @param string $typeC
     *
     * @return Contrat
     */
    public function setTypeC($typeC)
    {
        $this->typeC = $typeC;

        return $this;
    }

    /**
     * Get typeC
     *
     * @return string
     */
    public function getTypeC()
    {
        return $this->typeC;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Contrat
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set idChauff
     *
     * @param \ContratBundle\Entity\User $idChauff
     *
     * @return Contrat
     */
    public function setIdChauff(\ContratBundle\Entity\User $idChauff = null)
    {
        $this->idChauff = $idChauff;

        return $this;
    }

    /**
     * Get idChauff
     *
     * @return \ContratBundle\Entity\User
     */
    public function getIdChauff()
    {
        return $this->idChauff;
    }
}
