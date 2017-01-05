<?php

namespace Ndrm\EntityTestsBundle\Entity;

/**
 * UsersRoles
 */
class UsersRoles
{
    /**
     * @var integer
     */
    private $idRoles;

    /**
     * @var \Ndrm\EntityTestsBundle\Entity\Users
     */
    private $idUsers;


    /**
     * Set idRoles
     *
     * @param integer $idRoles
     *
     * @return UsersRoles
     */
    public function setIdRoles($idRoles)
    {
        $this->idRoles = $idRoles;

        return $this;
    }

    /**
     * Get idRoles
     *
     * @return integer
     */
    public function getIdRoles()
    {
        return $this->idRoles;
    }

    /**
     * Set idUsers
     *
     * @param \Ndrm\EntityTestsBundle\Entity\Users $idUsers
     *
     * @return UsersRoles
     */
    public function setIdUsers(\Ndrm\EntityTestsBundle\Entity\Users $idUsers)
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    /**
     * Get idUsers
     *
     * @return \Ndrm\EntityTestsBundle\Entity\Users
     */
    public function getIdUsers()
    {
        return $this->idUsers;
    }
}

