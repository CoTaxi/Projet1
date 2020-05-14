<?php


namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePaiement
 *
 * @ORM\Table(name="type_paiement")
 * @ORM\Entity(repositoryClass="TaxiCoBundle\Repository\TypePaiementRepository")
 */
class TypePaiement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="numCarte", type="integer")
     */
    private $numCarte;
    /**
     * @var integer
     *
     * @ORM\Column(name="codeSec", type="integer")
     */
    private $codeSec;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateExp", type="date")
     */
    private $dateExp;




    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numCarte
     *
     * @param integer $numCarte
     *
     * @return integer
     */
    public function setNumCarte($numCarte)
    {
        $this->numCarte = $numCarte;

        return $this;
    }

    /**
     * Get numCarte
     *
     * @return integer
     */
    public function getNumCarte()
    {
        return $this->numCarte;
    }

    /**
     * Set dateExp
     *
     * @param \DateTime $dateExp
     *
     * @return TypePaiement
     */
    public function setDateExp($dateExp)
    {
        $this->dateExp = $dateExp;

        return $this;
    }

    /**
     * Get dateExp
     *
     * @return \DateTime
     */
    public function getDateExp()
    {
        return $this->dateExp;
    }

    /**
     * @return int
     */
    public function getCodeSec()
    {
        return $this->codeSec;
    }

    /**
     * @param int $codeSec
     */
    public function setCodeSec($codeSec)
    {
        $this->codeSec = $codeSec;
    }

}

