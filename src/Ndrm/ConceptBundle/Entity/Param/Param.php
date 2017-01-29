<?php

namespace Ndrm\ConceptBundle\Entity\Param;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ndrm\ConceptBundle\Entity\Category\Category;

/**
 *
 * @ORM\Table(name="concept_params")
 * @ORM\Entity(repositoryClass="Ndrm\ConceptBundle\Repository\Param\ParamRepository")
 */
class Param {

    /**
     * @ORM\Column(name="id_concept_params"
     *              , type="integer"
     *              ,options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ndrm\ConceptBundle\Entity\Category\Category",inversedBy="params")
     * @ORM\JoinColumn(name="id_concept_categories"
     *                  ,referencedColumnName="id_concept_categories"
     *                  ,onDelete="CASCADE")
     */
    private $conceptCategory;

    /**
     * @ORM\OneToOne(targetEntity="Ndrm\ConceptBundle\Entity\Param\Input\Type")
     * @ORM\JoinColumn(name="id_concept_param_input_types"
     *                  , referencedColumnName="id_concept_param_input_types"
     *                  , onDelete="SET NULL")
     */
    private $inputType;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     * @Assert\NotBlank()
     * 
     */
    private $name;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ParamHtmlInputType
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    function getConceptCategory() {
        return $this->conceptCategory;
    }

    function getInputType() {
        return $this->inputType;
    }

    function setConceptCategory($conceptCategory) {
        $this->conceptCategory = $conceptCategory;
    }

    function setInputType($inputType) {
        $this->inputType = $inputType;
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

}
