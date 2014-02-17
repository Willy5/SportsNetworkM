<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerDetail
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
     * @var InstanceTeam
     * 
     * @ORM\ManyToOne(targetEntity="InstanceTeam", inversedBy="playersDetail")
     * @ORM\JoinColumn(name="instanceTeam_id", referencedColumnName="id", nullable=false)
     */
    private $instanceTeam;

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
     * Set instanceTeam
     *
     * @param InstanceTeam $instanceTeam
     * @return PlayerDetail
     */
    public function setInstanceTeam(InstanceTeam $instanceTeam = null)
    {
        $this->instanceTeam = $instanceTeam;
        
        return $this;
    }

    /**
     * Get instanceTeam
     *
     * @return InstanceTeam
     */
    public function getInstanceTeam()
    {
        return $this->instanceTeam;
    }

    /**
     * Set favoritePlayerNumber
     *
     * @param integer $favoritePlayerNumber
     * @return PlayerDetail
     */
    public function setFavoritePlayerNumber($favoritePlayerNumber)
    {
        $this->favoritePlayerNumber = $favoritePlayerNumber;

        return $this;
    }

    /**
     * Get favoritePlayerNumber
     *
     * @return integer 
     */
    public function getFavoritePlayerNumber()
    {
        return $this->favoritePlayerNumber;
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
}
