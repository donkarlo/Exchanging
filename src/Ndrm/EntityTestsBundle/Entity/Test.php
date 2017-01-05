<?php

namespace Ndrm\EntityTestsBundle\Entity;

/**
 * Test
 */
class Test
{
    /**
     * @var string
     */
    private $testtield1;

    /**
     * @var string
     */
    private $testfield2;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set testtield1
     *
     * @param string $testtield1
     *
     * @return Test
     */
    public function setTesttield1($testtield1)
    {
        $this->testtield1 = $testtield1;

        return $this;
    }

    /**
     * Get testtield1
     *
     * @return string
     */
    public function getTesttield1()
    {
        return $this->testtield1;
    }

    /**
     * Set testfield2
     *
     * @param string $testfield2
     *
     * @return Test
     */
    public function setTestfield2($testfield2)
    {
        $this->testfield2 = $testfield2;

        return $this;
    }

    /**
     * Get testfield2
     *
     * @return string
     */
    public function getTestfield2()
    {
        return $this->testfield2;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

