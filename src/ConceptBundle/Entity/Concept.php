<?php

namespace ConceptBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concept
 *
 * @ORM\Table(name="concepts")
 * @ORM\Entity(repositoryClass="ConceptBundle\Repository\ConceptRepository")
 */
class Concept
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_concepts", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="monit", type="string", length=255, unique=true)
     */
    private $monit;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set monit
     *
     * @param string $monit
     *
     * @return Concept
     */
    public function setMonit($monit)
    {
        $this->monit = $monit;

        return $this;
    }

    /**
     * Get monit
     *
     * @return string
     */
    public function getMonit()
    {
        return $this->monit;
    }
}

