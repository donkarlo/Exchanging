<?php

namespace Ndrm\LocationBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="locations")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class Location {

    /**
     * @ORM\Column(type="integer", name="id_locations",options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(length=64)
     * @Assert\NotBlank()
     */
    private $title;

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
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(referencedColumnName="id_locations", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id_locations", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Location", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getLocationId() {
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

    public function setParent(Location $parent = null) {
        $this->parent = $parent;
    }

    public function getParent() {
        return $this->parent;
    }

}
