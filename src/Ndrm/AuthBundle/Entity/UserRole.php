<?php

namespace Ndrm\AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRoles
 * Since I have defined the whole schema in User entity on the top of role property, I skip this here. I just kept this file as a guide although it is unnecessary 
 * @ORM\Entity(repositoryClass="Ndrm\AuthBundle\Repository\UserRoleRepository")
 */
class UserRole {

    /**
     * @ORM\Id
     * @ORM\Column(name="id_users", type="integer")
     * @ORM\OneToOne(targetEntity="User", cascade={"ALL"})
     * @ORM\JoinColumn(name="id_users", referencedColumnName="id_users")
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\Column(name="id_roles", type="integer")
     * @ORM\OneToOne(targetEntity="Role", cascade={"ALL"})
     * @ORM\JoinColumn(name="id_roles", referencedColumnName="id_roles")
     */
    private $role;
    
    public function __construct($user, $role) {
        $this->user = $user;
        $this->role = $role;
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
