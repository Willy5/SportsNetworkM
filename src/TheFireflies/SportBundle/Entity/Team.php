<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Team
 * 
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="TeamRepository")
 */
class Team
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
     * @var Club
     * 
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="teams")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     */
    private $club;
    
    /**
     * @var InstanceTeam
     * 
     * @ORM\OneToMany(targetEntity="InstanceTeam",
     *                mappedBy="team",
     *                cascade={"persist", "remove"},
     *                orphanRemoval=true)
     */
    private $instancesTeam;
    
    /**
     * @var Event
     * 
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="teams")
     */
    private $events;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, unique=false, nullable=false)
     */
    private $name;

    /**
     *
     * @var string
     * 
     * @Gedmo\Slug(fields={"name"}, updatable=true)
     * @ORM\Column(name="slug", type="string", length=255, unique=true, nullable=false)
     */
    private $slug;

    /**
     * @var string
     * 
     * @ORM\Column(name="division", type="string", length=255, unique=false, nullable=true)
     */
    private $division;

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
        $this->instancesTeam = new ArrayCollection();
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
     * Set club
     *
     * @param Club $club
     * @return Team
     */
    public function setClub(Club $club = null)
    {
        $this->club = $club;
        
        return $this;
    }

    /**
     * Get club
     *
     * @return Club
     */
    public function getClub()
    {
        return $this->club;
    }
    
    /**
     * Add instanceTeam
     *
     * @param InstanceTeam $instanceTeam
     * @return Team
     */
    public function addInstanceTeam(InstanceTeam $instanceTeam)
    {
        $this->instancesTeam[] = $instanceTeam;
    
        return $this;
    }

    /**
     * Remove instanceTeam
     *
     * @param InstanceTeam $instanceTeam
     */
    public function removeInstanceTeam(InstanceTeam $instanceTeam)
    {
        $this->instancesTeam->removeElement($instanceTeam);
    }

    /**
     * Get instancesTeam
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstancesTeam()
    {
        return $this->instancesTeam;
    }
    
    /**
     * Add event
     *
     * @param Event $event
     * @return Team
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    
        return $this;
    }

    /**
     * Remove event
     *
     * @param Event $event
     */
    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Team
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
     * Set division
     *
     * @param string $division
     * @return Team
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return string 
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Team
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

    /**
     * Set slug
     *
     * @param string $slug
     * @return Team
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add instancesTeam
     *
     * @param \TheFireflies\SportBundle\Entity\InstanceTeam $instancesTeam
     * @return Team
     */
    public function addInstancesTeam(\TheFireflies\SportBundle\Entity\InstanceTeam $instancesTeam)
    {
        $this->instancesTeam[] = $instancesTeam;

        return $this;
    }

    /**
     * Remove instancesTeam
     *
     * @param \TheFireflies\SportBundle\Entity\InstanceTeam $instancesTeam
     */
    public function removeInstancesTeam(\TheFireflies\SportBundle\Entity\InstanceTeam $instancesTeam)
    {
        $this->instancesTeam->removeElement($instancesTeam);
    }
}
