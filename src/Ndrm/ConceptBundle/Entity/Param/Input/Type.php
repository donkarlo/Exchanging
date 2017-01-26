<?php

namespace Ndrm\ConceptBundle\Entity\Param\Input;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="concept_param_input_types")
 * @ORM\Entity(repositoryClass="Ndrm\ConceptBundle\Repository\Param\Input\TypeRepository")
 */
class Type {

    /**
     * @var int
     *
     * @ORM\Column(name="id_concept_param_input_types"
     *              ,type="integer"
     *              ,options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title"
     *              , type="string"
     *              , length=100)
     */
    private $title;

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

}
