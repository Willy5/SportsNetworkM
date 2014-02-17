<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Club
 * 
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="ClubRepository")
 */
class Club
{
    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    
    /**
     * @var Team
     * 
     * @ORM\OneToMany(targetEntity="Team", mappedBy="club")
     */
    private $teams;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, unique=false, nullable=false)
     */
    private $name;

    /**
     * @var string
     * 
     * @Assert\Url()
     * @ORM\Column(name="website", type="string", length=255, unique=false, nullable=true)
     */
    private $website;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

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
     * Add team
     *
     * @param Team $team
     * @return Club
     */
    public function addTeam(Team $team)
    {
        $this->teams[] = $team;
    
        return $this;
    }

    /**
     * Remove team
     *
     * @param Team $team
     */
    public function removeTeam(Team $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Club
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
     * Set website
     *
     * @param string $website
     * @return Club
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }
}
