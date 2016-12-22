<?php

namespace ParamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParamType
 *
 * @ORM\Table(name="param_value_types")
 * @ORM\Entity(repositoryClass="ParamBundle\Repository\ParamTypeRepository")
 */
class ParamValueType {

    /**
     * @var int
     *
     * @ORM\Column(name="id_param_value_types", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="monitoring", type="string", length=100, unique=true)
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
     * Set monit
     *
     * @param string $monitoring
     *
     * @return ParamValueType
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
