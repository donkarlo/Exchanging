<?php

namespace Ndrm\AuthBundle\Entity;

use Ndrm\AuthBundle\Entity\Role;

/**
 * Just to handle userRoles form
 */
class UserRoles {

    /**
     *
     * @var mixed 
     */
    private $user;

    /**
     *
     * @var array 
     */
    private $roles;

    function __construct(User $user, $roles = null) {
        $this->user = $user;
        $this->setRoles($roles);
    }

    public function setRoles($roles) {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if (!$role instanceof Role) {
                    $exceptionMessage = "All roles must be instance of "
                            . Ndrm\AuthBundle\Entity\Role::class
                            . " try to construct UserRoles using builder"
                    ;
                    throw new \Exception($exceptionMessage);
                }
            }
            $this->roles = $roles;
        }
    }

    public function getRoles() {
        //@todo get roles for this user
        return $this->roles;
    }

    public function getRoleIds() {
        
    }

    public function getUser() {
        return $this->user;
    }

}
