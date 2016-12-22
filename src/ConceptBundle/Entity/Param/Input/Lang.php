<?php

namespace ConceptBundle\Entity\Param\Input;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="concept_param_input_langs")
 * @ORM\Entity(repositoryClass="ConceptBundle\Repository\Param\Input\Lang")
 */
class Lang {

    /**
     * @var int
     *
     * @ORM\Column(name="id_concept_param_input_langs", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="monitoring", type="string", length=100)
     */
    private $monitoring;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set monitoring
     *
     * @param string $monitoring
     *
     * @return ParamHtmlInputType
     */
    public function setMonitoring($monitoring) {
        $this->monitoring = $monitoring;

        return $this;
    }

    /**
     * Get monit
     *
     * @return string
     */
    public function getMonitoring() {
        return $this->monitoring;
    }

}
