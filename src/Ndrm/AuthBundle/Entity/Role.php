<?php

namespace Ndrm\AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Role
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="Ndrm\AuthBundle\Repository\RoleRepository")
 * @UniqueEntity(fields="role", message="the role name must be unique")
 */
class Role implements RoleInterface {

    /**
     * @var int
     *
     * @ORM\Column(name="id_roles", type="integer",options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="monitoring", type="string", length=25, unique=true)
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
     * Set role
     *
     * @param string $monitoring
     *
     * @return Role
     */
    public function setMonitoring($monitoring) {
        $this->monitoring = $this->prepareMonitoring($monitoring);
        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getMonitoring() {
        return $this->monitoring;
    }

    /**
     * 
     * @param string $monitoring
     * @return string
     */
    private function prepareMonitoring($monitoring) {
        $monitoring = strtoupper($monitoring);
        if (strpos($monitoring, "ROLE_") !== 0) {
            $monitoring = "ROLE_" . $monitoring;
        }
        return $monitoring;
    }

    public function getRole() {
        return $this->monitoring;
    }

}
