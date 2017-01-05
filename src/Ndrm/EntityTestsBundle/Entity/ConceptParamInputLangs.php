<?php

namespace Ndrm\EntityTestsBundle\Entity;

/**
 * ConceptParamInputLangs
 */
class ConceptParamInputLangs
{
    /**
     * @var string
     */
    private $monitoring;

    /**
     * @var integer
     */
    private $idConceptParamInputLangs;


    /**
     * Set monitoring
     *
     * @param string $monitoring
     *
     * @return ConceptParamInputLangs
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
     * Get idConceptParamInputLangs
     *
     * @return integer
     */
    public function getIdConceptParamInputLangs()
    {
        return $this->idConceptParamInputLangs;
    }
}

