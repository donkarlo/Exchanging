<?php

namespace ParamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Param
 *
 * @ORM\Table(name="params")
 * @ORM\Entity(repositoryClass="ParamBundle\Repository\ParamRepository")
 */
class Param {

    /**
     * @var int
     *
     * @ORM\Column(name="id_params", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_param_value_types", type="integer")
     * @ORM\ManyToOne(targetEntity="ParamValueType")
     * @ORM\JoinColumn(name="id_param_value_types", referencedColumnName="id_param_value_types")
     */
    private $valueType;

    /**
     * @var int
     *
     * @ORM\Column(name="id_html_input_types", type="integer")
     * @ORM\ManyToOne(targetEntity="ParamHtmlInputType")
     * @ORM\JoinColumn(name="id_html_input_types", referencedColumnName="id_html_input_types")
     */
    private $inputType;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set paramType
     *
     * @param integer $type
     *
     * @return Param
     */
    public function setValueType($type) {
        $this->valueType = $type;

        return $this;
    }

    /**
     * Get paramType
     *
     * @return int
     */
    public function getValueType() {
        return $this->valueType;
    }

    /**
     * 
     * @return int
     */
    public function getInputType() {
        return $this->inputType;
    }

    /**
     * 
     * @param integer $inputType
     */
    public function setInputType($inputType) {
        $this->inputType = $inputType;
    }

}
