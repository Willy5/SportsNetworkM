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
     * @var string
     *
     * @ORM\Column(name="nametest", type="string", length=255)
     */
    private $nametest;

    /**
     * Set nametest
     *
     * @param string $nametest
     * @return FriendlyEvent
     */
    public function setNametest($nametest)
    {
        $this->nametest = $nametest;

        return $this;
    }

    /**
     * Get nametest
     *
     * @return string 
     */
    public function getNametest()
    {
        return $this->nametest;
    }
}
