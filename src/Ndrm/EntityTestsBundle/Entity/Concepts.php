<?php

namespace Ndrm\EntityTestsBundle\Entity;

/**
 * Concepts
 */
class Concepts
{
    /**
     * @var string
     */
    private $monit;

    /**
     * @var integer
     */
    private $idConcepts;


    /**
     * Set monit
     *
     * @param string $monit
     *
     * @return Concepts
     */
    public function setMonit($monit)
    {
        $this->monit = $monit;

        return $this;
    }

    /**
     * Get monit
     *
     * @return string
     */
    public function getMonit()
    {
        return $this->monit;
    }

    /**
     * Get idConcepts
     *
     * @return integer
     */
    public function getIdConcepts()
    {
        return $this->idConcepts;
    }
}

