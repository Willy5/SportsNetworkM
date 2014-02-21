<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Sport
 * 
 * @ExclusionPolicy("all")
 * 
 * @UniqueEntity("name")
 * @Assert\Callback(methods={"isSportValid"})
 * 
 * @ORM\Table(name="sport")
 * @ORM\Entity(repositoryClass="SportRepository")
 */
class Sport
{
    /**
     * @var integer
     * 
     * @Expose
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * 
     * @Expose
     * 
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=false)
     */
    private $name;

    /**
     * @var integer
     * 
     * @Assert\Range(
     *      min = "1",
     *      minMessage = "Un minimum de un joueur est requis.",
     *      max = "30",
     *      maxMessage = "30 joueurs maximum par équipe est autorisé.")
     * @ORM\Column(name="nbPlayersMin", type="integer", unique=false, nullable=false)
     */
    private $nbPlayersMin;

    /**
     * @var integer
     * 
     * @Assert\Range(
     *      min = "1",
     *      minMessage = "Un minimum de un joueur est requis.",
     *      max = "30",
     *      maxMessage = "30 joueurs maximum par équipe est autorisé.")
     * @ORM\Column(name="nbPlayersMax", type="integer", unique=false, nullable=false)
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

    /**
     * Validation constraint
     */
    public function isSportValid(ExecutionContextInterface $context)
    {
        if($this->getNbPlayersMin() > $this->getNbPlayersMax())
        {
            $context->addViolationAt('nbPlayersMax', 'On ne peut pas avoir moins de joueurs max que de joueurs min', array(), null);
        }
    }
}
