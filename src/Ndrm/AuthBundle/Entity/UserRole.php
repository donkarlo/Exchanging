<?php

namespace Ndrm\AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * UserRoles
 *
 * @ORM\Table(name="users_roles")
 * @ORM\Entity(repositoryClass="Ndrm\AuthBundle\Repository\UserRoleRepository")
 */
class UserRole {

    /**
     * @var int
     *
     * @ORM\Column(name="id_users_roles", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="id_users", type="integer")
     * @ORM\OneToOne(targetEntity="User", cascade={"ALL"})
     * @ORM\JoinColumn(name="id_users", referencedColumnName="id_users")
     */
    private $user;

    /**
     * @ORM\Column(name="id_roles", type="integer")
     * @ORM\OneToOne(targetEntity="Role", cascade={"ALL"})
     * @ORM\JoinColumn(name="id_roles", referencedColumnName="id_roles")
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
     * Set user
     *
     * @param integer $user
     *
     * @return UserRoles
     */
    public function setUser($user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set role
     *
     * @param integer $role
     *
     * @return UserRoles
     */
    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     *
     * @return int
     */
    public function getRole() {
        return $this->role;
    }

}
