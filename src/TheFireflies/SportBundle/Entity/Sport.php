<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 */
class Sport
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $nbPlayersMin;

    /**
     * @var integer
     */
    private $nbPlayersMax;


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
     * Set name
     *
     * @param string $name
     * @return Sport
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nbPlayersMin
     *
     * @param integer $nbPlayersMin
     * @return Sport
     */
    public function setNbPlayersMin($nbPlayersMin)
    {
        $this->nbPlayersMin = $nbPlayersMin;

        return $this;
    }

    /**
     * Get nbPlayersMin
     *
     * @return integer 
     */
    public function getNbPlayersMin()
    {
        return $this->nbPlayersMin;
    }

    /**
     * Set nbPlayersMax
     *
     * @param integer $nbPlayersMax
     * @return Sport
     */
    public function setNbPlayersMax($nbPlayersMax)
    {
        $this->nbPlayersMax = $nbPlayersMax;

        return $this;
    }

    /**
     * Get nbPlayersMax
     *
     * @return integer 
     */
    public function getNbPlayersMax()
    {
        return $this->nbPlayersMax;
    }
}
