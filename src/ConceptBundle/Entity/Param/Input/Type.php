<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * ParamHtmlInputType
 *
 * @ORM\Table(name="param_input_types")
 * @ORM\Entity(repositoryClass="ParamBundle\Repository\ParamInputTypeRepository")
 */
class Type {

    /**
     * @var int
     *
     * @ORM\Column(name="id_param_input_types", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="monitoring", type="string", length=100)
     */
    private $monitoring;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set monitoring
     *
     * @param string $monitoring
     *
     * @return ParamHtmlInputType
     */
    public function setMonitoring($monitoring) {
        $this->monitoring = $monitoring;

        return $this;
    }

    /**
     * Get monit
     *
     * @return string
     */
    public function getMonitoring() {
        return $this->monitoring;
    }

}
