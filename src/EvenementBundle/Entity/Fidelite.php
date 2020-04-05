<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fidelite
 *
 * @ORM\Table(name="fidelite")
 * @ORM\Entity
 */
class Fidelite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_fid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFid;

    /**
     * @var integer
     *
     * @ORM\Column(name="point_fid", type="integer", nullable=false)
     */
    private $pointFid;

    /**
     * @var integer
     *
     * @ORM\Column(name="code_fid", type="integer", nullable=false)
     */
    private $codeFid;



    /**
     * Get idFid
     *
     * @return integer
     */
    public function getIdFid()
    {
        return $this->idFid;
    }

    /**
     * Set pointFid
     *
     * @param integer $pointFid
     *
     * @return Fidelite
     */
    public function setPointFid($pointFid)
    {
        $this->pointFid = $pointFid;

        return $this;
    }

    /**
     * Get pointFid
     *
     * @return integer
     */
    public function getPointFid()
    {
        return $this->pointFid;
    }

    /**
     * Set codeFid
     *
     * @param integer $codeFid
     *
     * @return Fidelite
     */
    public function setCodeFid($codeFid)
    {
        $this->codeFid = $codeFid;

        return $this;
    }

    /**
     * Get codeFid
     *
     * @return integer
     */
    public function getCodeFid()
    {
        return $this->codeFid;
    }
}
