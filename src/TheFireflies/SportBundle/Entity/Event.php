<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="TheFireflies\SportBundle\Entity\EventRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *      "fm" = "FriendlyEvent"})
 */
class Event
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
     * @var Team
     * 
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="events")
     * @ORM\JoinTable(name="events_teams")
     */
    private $teams;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginDate", type="date")
     */
    private $beginDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date")
     */
    private $endDate;


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
     * @return Event
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
     * @return Event
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
     * Set beginDate
     *
     * @param \DateTime $beginDate
     * @return Event
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get beginDate
     *
     * @return \DateTime 
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
