<?php

namespace Ndrm\ConceptBundle\Entity\Instance;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="concept_instance_param_values")
 * @ORM\Entity(repositoryClass="Ndrm\ConceptBundle\Repository\Instance\ParamValueRepository")
 */
class ParamValue {

    /**
     * @ORM\Column(name="id_concept_instance_param_values"
     *              , type="integer"
     *              ,options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ndrm\ConceptBundle\Entity\Instance",inversedBy="paramValues")
     * @ORM\JoinColumn(name="id_concept_instances"
     *                  ,referencedColumnName="id_concept_instances"
     *                  ,onDelete="CASCADE")
     * @Assert\Valid()
     */
    private $instance;

    /**
     * @ORM\ManyToOne(targetEntity="Ndrm\ConceptBundle\Entity\Param\Param")
     * @ORM\JoinColumn(name="id_concept_params"
     *                  ,referencedColumnName="id_concept_params"
     *                  ,onDelete="CASCADE")
     * @Assert\Valid()
     */
    private $param;

    /**
     * @ORM\Column(name="value"
     *              , type="string"
     *              ,length=100)
     */
    private $value;

    function getInstance() {
        return $this->instance;
    }

    function getParam() {
        return $this->param;
    }

    /**
     * 
     * @param type $instance
     */
    function setInstance($instance) {
        $this->instance = $instance;
    }

    /**
     * The concept param
     * @param type $param
     */
    function setParam($param) {
        $this->param = $param;
    }

    function getId() {
        return $this->id;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

}
