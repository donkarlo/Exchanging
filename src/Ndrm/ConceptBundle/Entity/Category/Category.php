<?php

namespace Ndrm\ConceptBundle\Entity\Category;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="concept_categories")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class Category {

    /**
     * @ORM\Column(type="integer", name="id_concept_categories",options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(length=64)
     * @Assert\NotBlank()
     */
    private $title;

    /*     * *
     * @ORM\Column(length=200)
     * @Assert\Length(
     *      max = 200,
     *      maxMessage = "حداکثر تعداد حروف مجاز {{limit}} است"
     * )
     */
    //private $description;

    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @ORM\OneToMany(targetEntity="\Ndrm\ConceptBundle\Entity\Param\Param"
     *                  , mappedBy="conceptCategory"
     *                  ,cascade={"all"})
     */
    private $params;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer",options={"unsigned":true})
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer",options={"unsigned":true})
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer",options={"unsigned":true})
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(referencedColumnName="id_concept_categories", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id_concept_categories", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    public function __construct() {
        $this->params = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getCategoryId() {
        return $this->getId();
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getRoot() {
        return $this->root;
    }

    public function setParent(Category $parent = null) {
        $this->parent = $parent;
    }

    public function getParent() {
        return $this->parent;
    }

}
