<?php

namespace TheFireflies\SportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FriendlyEvent
 *
 * @ORM\Table(name="friendlyEvent")
 * @ORM\Entity
 */
class FriendlyEvent extends Event
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
