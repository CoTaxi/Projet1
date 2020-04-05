<?php

namespace TaxiCoBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\GroupInterface;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="mail", columns={"mail"})}, indexes={@ORM\Index(name="id_eventfk", columns={"nom_event"}), @ORM\Index(name="ptfidid", columns={"point_fidelite"})})
 * @ORM\Entity
 * * @ORM\DiscriminatorMap({
 *     "Admin"="Admin",
 *     "chauffeur"="chauffeur",
 *     "client"="client",
 *     "User"="User"
 * })
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_u", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id
    ;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=250, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=250, nullable=true)
     */
    private $prenom;

    /**
     * @var integer
     *
     * @ORM\Column(name="tel", type="integer", nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=250, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=250, nullable=true)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="naissance", type="string", length=250, nullable=true)
     */
    private $naissance;

    /**
     * @var string
     *
     * @ORM\Column(name="creation", type="string", length=250, nullable=true)
     */
    private $creation;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=250, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=250, nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="cin", type="integer", nullable=true)
     */
    private $cin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="permis", type="integer", nullable=true)
     */
    private $permis = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nom_compte", type="string", length=250, nullable=true)
     */
    private $nomCompte = 'none';

    /**
     * @var integer
     *
     * @ORM\Column(name="rib_compte", type="integer", nullable=true)
     */
    private $ribCompte = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="experience", type="integer", nullable=true)
     */
    private $experience = '0';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_course", type="integer", nullable=true)
     */
    private $nbrCourse;

    /**
     * @var integer
     *
     * @ORM\Column(name="point_fidelite", type="integer", nullable=true)
     */
    private $pointFidelite = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=11, nullable=true)
     */
    private $nomEvent = 'none';



    /**
     * Get idU
     *
     * @return integer
     */
    public function getIdU()
    {
        return $this->idU;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return integer
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return User
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set naissance
     *
     * @param string $naissance
     *
     * @return User
     */
    public function setNaissance($naissance)
    {
        $this->naissance = $naissance;

        return $this;
    }

    /**
     * Get naissance
     *
     * @return string
     */
    public function getNaissance()
    {
        return $this->naissance;
    }

    /**
     * Set creation
     *
     * @param string $creation
     *
     * @return User
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;

        return $this;
    }

    /**
     * Get creation
     *
     * @return string
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     *
     * @return User
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return integer
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set permis
     *
     * @param integer $permis
     *
     * @return User
     */
    public function setPermis($permis)
    {
        $this->permis = $permis;

        return $this;
    }

    /**
     * Get permis
     *
     * @return integer
     */
    public function getPermis()
    {
        return $this->permis;
    }

    /**
     * Set nomCompte
     *
     * @param string $nomCompte
     *
     * @return User
     */
    public function setNomCompte($nomCompte)
    {
        $this->nomCompte = $nomCompte;

        return $this;
    }

    /**
     * Get nomCompte
     *
     * @return string
     */
    public function getNomCompte()
    {
        return $this->nomCompte;
    }

    /**
     * Set ribCompte
     *
     * @param integer $ribCompte
     *
     * @return User
     */
    public function setRibCompte($ribCompte)
    {
        $this->ribCompte = $ribCompte;

        return $this;
    }

    /**
     * Get ribCompte
     *
     * @return integer
     */
    public function getRibCompte()
    {
        return $this->ribCompte;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     *
     * @return User
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return integer
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set nbrCourse
     *
     * @param integer $nbrCourse
     *
     * @return User
     */
    public function setNbrCourse($nbrCourse)
    {
        $this->nbrCourse = $nbrCourse;

        return $this;
    }

    /**
     * Get nbrCourse
     *
     * @return integer
     */
    public function getNbrCourse()
    {
        return $this->nbrCourse;
    }

    /**
     * Set pointFidelite
     *
     * @param integer $pointFidelite
     *
     * @return User
     */
    public function setPointFidelite($pointFidelite)
    {
        $this->pointFidelite = $pointFidelite;

        return $this;
    }

    /**
     * Get pointFidelite
     *
     * @return integer
     */
    public function getPointFidelite()
    {
        return $this->pointFidelite;
    }

    /**
     * Set nomEvent
     *
     * @param string $nomEvent
     *
     * @return User
     */
    public function setNomEvent($nomEvent)
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    /**
     * Get nomEvent
     *
     * @return string
     */
    public function getNomEvent()
    {
        return $this->nomEvent;
    }

}


