<?php

namespace Ndrm\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Ndrm\AuthBundle\Entity\UserRoles;
use Ndrm\AuthBundle\Entity\UserRole;

/**
 * The pre route to this bundle is concept
 * @Route("user-roles")
 */
class UserRolesController extends Controller {

    /**
     * @Route("/set/{idUsers}", requirements={"idUsers" = "\d+"}, name="set_user_roles")
     * @Method({"GET", "POST"})
     */
    public function setRoles(Request $request, $idUsers) {
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $userRolesRepository = $em->getRepository("NdrmAuthBundle:UserRole");
        if ($request->query->has("submit")) {
            if ($session->get("_token") == $request->get("_token")) {
                $session->remove("_token");
                $userRolesRepository->deleteAllUserRolesByIdUsers($idUsers);
                foreach ($request->get("checkedRoleIds") as $checkedRoleId) {
                    $userRole = new UserRole();
                    $userRole->setRole($checkedRoleId);
                    $userRole->setUser($idUsers);
                    $em->presist($userRole);
                    $em->flush();
                }
                $this->redirectToRoute("user_index");
            } else {
                die("Haha");
            }
        } else {
        $roleRepository = $em->getRepository("NdrmAuthBundle:Role");
        $allRolesAndTheirIds = $roleRepository->getAllRolesAndTheirIds();
        $viewVars["allRolesAndTheirIds"] = $allRolesAndTheirIds;
        $userRoleIds = $userRolesRepository->getAUserIdRoles($idUsers);
        $viewVars["userRoleIds"] = $userRoleIds;
        $userRepository = $em->getRepository("NdrmAuthBundle:User");
        $username = $userRepository->getUsernameByIdUsers($idUsers);
        $viewVars["username"] = $username;
        $token = md5(rand(1, 10000000));
        $session->$session->set('_token', $token);
        $viewVars["_token"] = $token;
        return $this->render("NdrmAuthBundle:Crud:index.html.twig"
                        , $viewVars);
        }
    }

}
