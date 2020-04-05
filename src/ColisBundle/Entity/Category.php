<?php

namespace ColisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category", uniqueConstraints={@ORM\UniqueConstraint(name="categorie", columns={"categorie"})})
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcatergory", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcatergory;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=250, nullable=false)
     */
    private $categorie;



    /**
     * Get idcatergory
     *
     * @return integer
     */
    public function getIdcatergory()
    {
        return $this->idcatergory;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Category
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    public function __toString()
    {
       return $this->categorie;
    }

}
