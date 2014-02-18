<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * InstanceTeam
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class InstanceTeam
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
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="instancesTeam")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=false)
     */
    private $team;
    
    /**
     * @var PlayerDetail
     * 
     * @ORM\OneToMany(targetEntity="PlayerDetail",
     *                mappedBy="instanceTeam",
     *                cascade={"persist", "remove"},
     *                orphanRemoval=true)
     */
    private $playersDetail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginDate", type="date", nullable=false)
     */
    private $beginDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date", nullable=true)
     */
    private $endDate;


    /**
     * Construct
     */
    public function __construct()
    {
        $this->playersDetail = new ArrayCollection();
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
     * Set team
     *
     * @param Team $team
     * @return InstanceTeam
     */
    public function setTeam(Team $team = null)
    {
        $this->team = $team;
        
        return $this;
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }
    
    /**
     * Add playerDetail
     *
     * @param PlayerDetail $playerDetail
     * @return InstanceTeam
     */
    public function addPlayerDetail(PlayerDetail $playerDetail)
    {
        $this->playersDetail[] = $playerDetail;
    
        return $this;
    }

    /**
     * Remove playerDetail
     *
     * @param PlayerDetail $playerDetail
     */
    public function removePlayerDetail(PlayerDetail $playerDetail)
    {
        $this->playersDetail->removeElement($playerDetail);
    }

    /**
     * Get playersDetail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayersDetail()
    {
        return $this->playersDetail;
    }

    /**
     * Set beginDate
     *
     * @param \DateTime $beginDate
     * @return InstanceTeam
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
     * @return InstanceTeam
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
