<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * PlayerDetail
 * 
 * @Assert\Callback(methods={"isPlayerDetailValid"})
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PlayerDetail
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
     * @var TheFireflies\UserBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="TheFireflies\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @var InstanceTeam
     * 
     * @ORM\ManyToOne(targetEntity="InstanceTeam", inversedBy="playersDetail")
     * @ORM\JoinColumn(name="instanceTeam_id", referencedColumnName="id", nullable=false)
     */
    private $instanceTeam;

    /**
     *
     * @var TheFireflies\UserBundle\Entity\User $createdBy
     * 
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="TheFireflies\UserBundle\Entity\User")
     */
    private $createdBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="playerNumber", type="smallint")
     */
    private $playerNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255, nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="nameIfGuest", type="string", length=255, nullable=true)
     */
    private $nameIfGuest;


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
     * Validation constraint
     */
    public function isPlayerDetailValid(ExecutionContextInterface $context)
    {
        $user = $this->getUser();
        $nameIfGuest = $this->getNameIfGuest();
        if(! empty($user) && ! empty($nameIfGuest))
        {
            $context->addViolationAt('nameIfGuest', 'On ne peut pas définir de nom si la fiche joueur est déjà liée à un membre', array(), null);
        }
        else if (empty($user) && empty($nameIfGuest))
        {
            $context->addViolationAt('user', 'Une fiche joueur doit être liée à un utilisateur. Si la personne concernée n\'a pas de compte sur le site, remplissez le champs "Nom si invité".', array(), null);
        }
    }

    /**
     * Set playerNumber
     *
     * @param integer $playerNumber
     * @return PlayerDetail
     */
    public function setPlayerNumber($playerNumber)
    {
        $this->playerNumber = $playerNumber;

        return $this;
    }

    /**
     * Get playerNumber
     *
     * @return integer 
     */
    public function getPlayerNumber()
    {
        return $this->playerNumber;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return PlayerDetail
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set nameIfGuest
     *
     * @param string $nameIfGuest
     * @return PlayerDetail
     */
    public function setNameIfGuest($nameIfGuest)
    {
        $this->nameIfGuest = $nameIfGuest;

        return $this;
    }

    /**
     * Get nameIfGuest
     *
     * @return string 
     */
    public function getNameIfGuest()
    {
        return $this->nameIfGuest;
    }

    /**
     * Set instanceTeam
     *
     * @param \TheFireflies\SportBundle\Entity\InstanceTeam $instanceTeam
     * @return PlayerDetail
     */
    public function setInstanceTeam(\TheFireflies\SportBundle\Entity\InstanceTeam $instanceTeam)
    {
        $this->instanceTeam = $instanceTeam;

        return $this;
    }

    /**
     * Get instanceTeam
     *
     * @return \TheFireflies\SportBundle\Entity\InstanceTeam 
     */
    public function getInstanceTeam()
    {
        return $this->instanceTeam;
    }

    /**
     * Set user
     *
     * @param \TheFireflies\UserBundle\Entity\User $user
     * @return PlayerDetail
     */
    public function setUser(\TheFireflies\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \TheFireflies\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set createdBy
     *
     * @param \TheFireflies\UserBundle\Entity\User $createdBy
     * @return PlayerDetail
     */
    public function setCreatedBy(\TheFireflies\UserBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \TheFireflies\UserBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}
