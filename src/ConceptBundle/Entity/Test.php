<?php

namespace ConceptBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="ConceptBundle\Repository\TestRepository")
 */
class Test
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="testTield1", type="string", length=255)
     */
    private $testTield1;

    /**
     * @var string
     *
     * @ORM\Column(name="testField2", type="string", length=255)
     */
    private $testField2;


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
     * Set testTield1
     *
     * @param string $testTield1
     *
     * @return Test
     */
    public function setTestTield1($testTield1)
    {
        $this->testTield1 = $testTield1;

        return $this;
    }

    /**
     * Get testTield1
     *
     * @return string
     */
    public function getTestTield1()
    {
        return $this->testTield1;
    }

    /**
     * Set testField2
     *
     * @param string $testField2
     *
     * @return Test
     */
    public function setTestField2($testField2)
    {
        $this->testField2 = $testField2;

        return $this;
    }

    /**
     * Get testField2
     *
     * @return string
     */
    public function getTestField2()
    {
        return $this->testField2;
    }
}

