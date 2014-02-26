<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * SportMatch
 * 
 * @Assert\Callback(methods={"isSportMatchValid"})
 * 
 * @ORM\Table(name="sportmatch")
 * @ORM\Entity(repositoryClass="TheFireflies\SportBundle\Entity\SportMatchRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *      "fm" = "FriendlyMatch"})
 */
class SportMatch
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
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="home_team_id", referencedColumnName="id", nullable=false)
     */
    private $homeTeam;
    
    /**
     * @var Team
     * 
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="away_team_id", referencedColumnName="id", nullable=false)
     */
    private $awayTeam;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text", nullable=true)
     */
    private $summary;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginTime", type="time", nullable=true)
     */
    private $beginTime;

    /**
     * @var integer
     * @Assert\Range(
     *      min = "0",
     *      minMessage = "Le statut est de minimum zéro.",
     *      max = "3",
     *      maxMessage = "Le statut est de maximum 3.")
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var integer
     * @Assert\Range(
     *      min = "0",
     *      minMessage = "Le score maximal est 0.",
     *      max = "200",
     *      maxMessage = "Le score maximal est 200.")
     * @ORM\Column(name="scoreHomeTeam", type="integer", nullable=false)
     */
    private $scoreHomeTeam;

    /**
     * @var integer
     * @Assert\Range(
     *      min = "0",
     *      minMessage = "Le score maximal est 0.",
     *      max = "200",
     *      maxMessage = "Le score maximal est 200.")
     * @ORM\Column(name="scoreAwayTeam", type="integer", nullable=false)
     */
    private $scoreAwayTeam;


    /**
     * Construct
     */
    public function __construct()
    {
        $this->status = 0;
        $this->scoreHomeTeam = 0;
        $this->scoreAwayTeam = 0;
    }
    
    public function getStatusList()
    {
        $statusList = array();
        $statusList[0] = "Match non commencé";
        $statusList[1] = "Match terminé";
        $statusList[2] = "Match forfait : L'équipe à domicile à déclarée forfait (L'équipe à l'extérieur gagne).";
        $statusList[3] = "Match forfait : L'équipe à l'extérieur à déclarée forfait (L'équipe à domicile gagne).";
        
        return $statusList;
    }


    /**
     * Validation constraint
     */
    public function isSportMatchValid(ExecutionContextInterface $context)
    {
        if($this->homeTeam->getId() == $this->awayTeam->getId())
        {
            $context->addViolationAt('awayTeam', 'L\'équipe visiteuse ne peut pas être la même que l\'équipe receveuse', array(), null);
        }
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
     * Set summary
     *
     * @param string $summary
     * @return SportMatch
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return SportMatch
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set beginTime
     *
     * @param \DateTime $beginTime
     * @return SportMatch
     */
    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;

        return $this;
    }

    /**
     * Get beginTime
     *
     * @return \DateTime 
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * Set homeTeam
     *
     * @param \TheFireflies\SportBundle\Entity\Team $homeTeam
     * @return SportMatch
     */
    public function setHomeTeam(\TheFireflies\SportBundle\Entity\Team $homeTeam = null)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * Get homeTeam
     *
     * @return \TheFireflies\SportBundle\Entity\Team 
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * Set awayTeam
     *
     * @param \TheFireflies\SportBundle\Entity\Team $awayTeam
     * @return SportMatch
     */
    public function setAwayTeam(\TheFireflies\SportBundle\Entity\Team $awayTeam = null)
    {
        $this->awayTeam = $awayTeam;

        return $this;
    }

    /**
     * Get awayTeam
     *
     * @return \TheFireflies\SportBundle\Entity\Team 
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * Set status
     *
     * @param \int $status
     * @return SportMatch
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \int 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set scoreHomeTeam
     *
     * @param integer $scoreHomeTeam
     * @return SportMatch
     */
    public function setScoreHomeTeam($scoreHomeTeam)
    {
        $this->scoreHomeTeam = $scoreHomeTeam;

        return $this;
    }

    /**
     * Get scoreHomeTeam
     *
     * @return integer 
     */
    public function getScoreHomeTeam()
    {
        return $this->scoreHomeTeam;
    }

    /**
     * Set scoreAwayTeam
     *
     * @param integer $scoreAwayTeam
     * @return SportMatch
     */
    public function setScoreAwayTeam($scoreAwayTeam)
    {
        $this->scoreAwayTeam = $scoreAwayTeam;

        return $this;
    }

    /**
     * Get scoreAwayTeam
     *
     * @return integer 
     */
    public function getScoreAwayTeam()
    {
        return $this->scoreAwayTeam;
    }
}
