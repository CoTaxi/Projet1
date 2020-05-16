<?php

namespace ColisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chat
 *
 * @ORM\Table(name="chat")
 * @ORM\Entity(repositoryClass="ColisBundle\Repository\chatRepository")
 */
class chat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idsender", type="integer")
     */
    private $idsender;

    /**
     * @var int
     *
     * @ORM\Column(name="idreceiver", type="integer")
     */
    private $idreceiver;

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="string", length=255)
     */
    private $msg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idsender
     *
     * @param integer $idsender
     *
     * @return chat
     */
    public function setIdsender($idsender)
    {
        $this->idsender = $idsender;

        return $this;
    }

    /**
     * Get idsender
     *
     * @return int
     */
    public function getIdsender()
    {
        return $this->idsender;
    }

    /**
     * Set idreceiver
     *
     * @param integer $idreceiver
     *
     * @return chat
     */
    public function setIdreceiver($idreceiver)
    {
        $this->idreceiver = $idreceiver;

        return $this;
    }

    /**
     * Get idreceiver
     *
     * @return int
     */
    public function getIdreceiver()
    {
        return $this->idreceiver;
    }

    /**
     * Set msg
     *
     * @param string $msg
     *
     * @return chat
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return chat
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }
}

