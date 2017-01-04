<?php

namespace Ndrm\AuthBundle\Repository;

/**
 * RoleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoleRepository extends \Doctrine\ORM\EntityRepository {

    public function getAllRolesAndTheirIds() {
        $qb = $this->createQueryBuilder("getAllRolesAndTheirIds");
        $allRolesAndIds = $qb->select("r.id,r.role")
                ->from("roles", "r");
        return $allRolesAndIds;
    }

}