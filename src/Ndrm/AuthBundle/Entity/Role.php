<?php

namespace Ndrm\AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Role
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="Ndrm\AuthBundle\Repository\RoleRepository")
 * @UniqueEntity(fields="role", message="the role name must be unique")
 */
class Role {

    /**
     * @var int
     *
     * @ORM\Column(name="id_roles", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=25, unique=true)
     */
    private $role;

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
     * @param string $role
     *
     * @return Role
     */
    public function setRole($role) {
        $this->role = $this->prepareRole($role);
        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * 
     * @param string $role
     * @return string
     */
    private function prepareRole($role) {
        $role = strtoupper($role);
        if (strpos($role, "ROLE_") !== 0) {
            $role = "ROLE_" . $role;
        }
        return $role;
    }

}
