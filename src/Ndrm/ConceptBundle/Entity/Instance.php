<?php

namespace Ndrm\ConceptBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="concept_instances")
 * @ORM\Entity(repositoryClass="Ndrm\ConceptBundle\Repository\InstanceRepository")
 */
class Instance {

    /**
     * @ORM\Column(name="id_concept_instances"
     *              , type="integer"
     *              ,options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ndrm\AuthBundle\Entity\User")
     * @ORM\JoinColumn(name="id_users"
     *                  ,referencedColumnName="id_users"
     *                  ,onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Ndrm\LocationBundle\Entity\Location")
     * @ORM\JoinColumn(name="id_locations"
     *                  , referencedColumnName="id_locations"
     *                  , onDelete="SET NULL")
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Ndrm\ConceptBundle\Entity\Category\Category")
     * @ORM\JoinColumn(name="id_concept_categories"
     *                  , referencedColumnName="id_concept_categories"
     *                  , onDelete="SET NULL")
     * @Assert\Valid()
     */
    private $conceptCategory;

    /**
     * @ORM\OneToMany(targetEntity="Ndrm\ConceptBundle\Entity\Instance\ParamValue"
     * ,mappedBy="instance" 
     * ,cascade={"persist"}
     * )
     */
    private $paramValues;

    /**
     * @var string
     *
     * @ORM\Column(name="title"
     *  , type="string"
     *  , length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description"
     *  , type="string"
     *  , length=200)
     */
    private $description;

    /**
     * @ORM\Column(name="last_updated"
     *  , type="datetime")
     */
    private $lastUpdated;

    public function __construct() {
        $this->paramValues = new ArrayCollection();
        $this->lastUpdated = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $title
     * @return string
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * 
     * @return type
     */
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

    /**
     * 
     * @return string
     */
    function getDescription() {
        return $this->description;
    }

    /**
     * 
     * @param string $description
     */
    function setDescription($description) {
        $this->description = $description;
    }

    /**
     * 
     * @return type
     */
    function getUser() {
        return $this->user;
    }

    /**
     * 
     * @return type
     */
    function getLocation() {
        return $this->location;
    }

    /**
     * 
     * @param type $user
     */
    function setUser($user) {
        $this->user = $user;
    }

    /**
     * 
     * @param type $location
     */
    function setLocation($location) {
        $this->location = $location;
    }

    public function getParamValues() {
        return $this->paramValues;
    }

    public function getLastUpdated() {
        return $this->lastUpdated;
    }

    /**
     * 
     * @param mixed $paramValues
     */
    public function setParamValues($paramValues) {
        if ($paramValues instanceof ArrayCollection) {
            if (!$paramValues->isEmpty()) {
                foreach ($paramValues->getValues() as $value) {
                    $value->setInstance($this);
                }
            }
        }
        $this->paramValues = $paramValues;
    }

    /**
     * 
     * @param type $lastUpdated
     */
    public function setLastUpdated(\DateTime $lastUpdated) {
        $this->lastUpdated = $lastUpdated;
    }

}
