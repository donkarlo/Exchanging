<?php

namespace Ndrm\AuthBundle\Entity;

use Ndrm\AuthBundle\Entity\Role;

/**
 * Description of UserRolesBuilder
 *
 * @author root
 */
class UserRolesBuilder {

    private $roles;
    private $user;

    public function addRule($role) {
        if ($role instanceof Role) {
            $this->roles[] = $role;
        }
        return $this;
    }

    public function setUser($user) {
        
    }

    public function getInstance() {
        
    }

}
