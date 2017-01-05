<?php

namespace Ndrm\EntityTestsBundle\Entity;

/**
 * Roles
 */
class Roles
{
    /**
     * @var string
     */
    private $monitoring;

    /**
     * @var integer
     */
    private $idRoles;


    /**
     * Set monitoring
     *
     * @param string $monitoring
     *
     * @return Roles
     */
    public function setMonitoring($monitoring)
    {
        $this->monitoring = $monitoring;

        return $this;
    }

    /**
     * Get monitoring
     *
     * @return string
     */
    public function getMonitoring()
    {
        return $this->monitoring;
    }

    /**
     * Get idRoles
     *
     * @return integer
     */
    public function getIdRoles()
    {
        return $this->idRoles;
    }
}

