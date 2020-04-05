<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodePromo
 *
 * @ORM\Table(name="code_promo")
 * @ORM\Entity
 */
class CodePromo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="balance", type="integer", nullable=false)
     */
    private $balance;



    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set balance
     *
     * @param integer $balance
     *
     * @return CodePromo
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }
}
