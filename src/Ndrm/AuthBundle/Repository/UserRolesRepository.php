<?php

namespace Ndrm\AuthBundle\Repository;

use Ndrm\AuthBundle\Entity\Role;
use Ndrm\AuthBundle\Entity\UserRole;

/**
 * Description of UserRolesRepository
 *
 * @author root
 */
class UserRolesRepository extends \Doctrine\ORM\EntityRepository {

    public function getUserRoles($idUsers) {
        $qb = $this->createQueryBuilder("userRoleManaging");
        $userRoles = $qb->select("u.username,r.id_roles,r.role")
                ->from("users_roles", "ur")
                ->innerJoin("ur"
                        , "users"
                        , "u"//alias name
                        , "ur.id_users=u.id_users")
                ->innerJoin("ur"
                        , "roles"
                        , "r"//alias name
                        , "ur.id_roles=r.id_roles")
                ->where("users.id_users=?1")
                ->orderBy("r.role")
                ->setParameter(1, $idUsers)
                ->getResults()
        ;
        return $userRoles;
    }

    public function getAUserIdRoles($idUsers) {
        $qb = $this->createQueryBuilder("getAUserIdRoles");
        $idRoles = $qb->select("ur.id_roles")
                ->from("users_roles", "ur")
                ->where("users.id_users=?1")
                ->setParameter(1, $idUsers);
        return $idRoles;
    }

    public function deleteAllUserRolesByIdUsers($idUsers) {
        $qb = $this->createQueryBuilder("deleteAllRolesOfAUser");
        $qb->delete("users_roles")
                ->where("users_roles.id_users=?1")
                ->setParameter(1, $idUsers)
                ->getQuery()
                ->getResult()
                ;
    }

    /**
     * 
     * @param array $roleIds
     */
    public function insertRolesToAUser($userId, $roleIds) {
        $em = $this->getEntityManager();
        if (is_array($roleIds)) {
            foreach ($roleIds as $roleId) {
                $userRole = new UserRole();
                $userRole->setRole($roleId);
                $userRole->setUser($userId);
                $em->persist($userRole);
                $em->flush($userRole);
            }
        }
    }

}
