<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * InstanceTeam
 *
 * @Assert\Callback(methods={"isInstanceTeamValid"})
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
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="teamInstances")
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
     * @var \Date
     * 
     * @ORM\Column(name="beginDate", type="date", nullable=false)
     */
    private $beginDate;

    /**
     * @var \Date
     * 
     * @Assert\GreaterThanOrEqual({"$beginDate"})
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
     * Validation constraint
     */
    public function isInstanceTeamValid(ExecutionContextInterface $context)
    {
        $beginDate = $this->getBeginDate();
        $endDate = $this->getEndDate();
        $allTeamInstances = $this->getTeam()->getTeamInstances();
        if(! empty($endDate))
        {
            if($endDate < $beginDate)
            {
                
            }
            
        }

        // On vérifie que la durée effective ne coupe pas 
        if(! empty($allTeamInstances))
        {
            foreach ($allTeamInstances as $teamInstance)
            {
                $beginDateTeamInstance = $teamInstance->getBeginDate();
                $endDateTeamInstance = $teamInstance->getEndDate();
                if ($teamInstance->getId() != $this->getId()) // this getId marche ? A-t-on l'Id pour le moment ?
                {
                    if ($this->getEndDate() == null)
                    {
                        if($endDateTeamInstance == null)
                        {
                            $context->addViolationAt('beginDate', 'La durée de cette composition d\'équipe chevauche celle d\'une autre ! Cette composition d\'équipe, tout comme une autre, n\'a pas de date de fin. Or, seule la dernière composition d\'équipe peut ne pas avoir de date de fin. Veuillez d\'abord donner une date de fin à l\'autre composition.', array(), null);
                        }
                        else if ($endDateTeamInstance >= $this->getBeginDate())
                        {
                            $context->addViolationAt('beginDate', 'La durée de cette composition d\'équipe chevauche celle d\'une autre !', array(), null);
                        }
                    }
                    else
                    {
                        if ($beginDateTeamInstance <= $this->getEndDate())
                        {
                            if($endDateTeamInstance == null)
                            {
                                $context->addViolationAt('beginDate', 'La durée de cette composition d\'équipe chevauche celle d\'une autre ! (Cette autre composition n\'a pas de date de fin, veuillez lui en assigner une d\'abord)', array(), null);
                            }
                            else if ($endDateTeamInstance >= $this->getBeginDate())
                            {
                                $context->addViolationAt('beginDate', 'La durée de cette composition d\'équipe chevauche celle d\'une autre !', array(), null);
                            }
                        }
                    }
                }
            }
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
     * Set team
     *
     * @param Team $team
     * @return InstanceTeam
     */
    public function setTeam(Team $team)
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
