<?php

namespace TaxiCoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 *
 * @ORM\Table(name="invitation")
 * @ORM\Entity
 */
class Invitation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email_sender", type="string", length=50, nullable=false)
     */
    private $emailSender;

    /**
     * @var string
     *
     * @ORM\Column(name="email_recipient", type="string", length=50, nullable=false)
     */
    private $emailRecipient;



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
     * Set emailSender
     *
     * @param string $emailSender
     *
     * @return Invitation
     */
    public function setEmailSender($emailSender)
    {
        $this->emailSender = $emailSender;

        return $this;
    }

    /**
     * Get emailSender
     *
     * @return string
     */
    public function getEmailSender()
    {
        return $this->emailSender;
    }

    /**
     * Set emailRecipient
     *
     * @param string $emailRecipient
     *
     * @return Invitation
     */
    public function setEmailRecipient($emailRecipient)
    {
        $this->emailRecipient = $emailRecipient;

        return $this;
    }

    /**
     * Get emailRecipient
     *
     * @return string
     */
    public function getEmailRecipient()
    {
        return $this->emailRecipient;
    }
}
