<?php

namespace Ndrm\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Ndrm\AuthBundle\Entity\UserRole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * The pre route to this bundle is concept
 * @Route("user-roles")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserRolesController extends Controller {

    /**
     * @Route("/set/{idUsers}", requirements={"idUsers" = "\d+"}, name="set_user_roles")
     * @Method({"GET", "POST"})
     */
    public function setRoles(Request $request, $idUsers) {
        $session = new Session();
        //
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository("NdrmAuthBundle:User");
        $userEntity = $userRepository->find($idUsers);
        //Submitting phase
        if ($request->get("submit")) {
            if ($session->get("_token") == $request->get("_token")) {
                $session->remove("_token");
                $userEntity->deletAllRoles();
                $em->persist($userEntity);
                $em->flush();
                foreach ($request->get("checkedRoleIds") as $checkedRoleId) {
                    $userRole = new UserRole($idUsers, $checkedRoleId);
                    $em->persist($userRole);
                    $em->flush();
                }
                return $this->redirectToRoute("user_index");
            } else {
                die("Haha");
            }
        } else {//Showing phase
            //Finding all avaialble roles
            $roleRepository = $em->getRepository("NdrmAuthBundle:Role");
            $allRolesMonitpringsAndTheirIds = $roleRepository->getAllMonitpringsAndTheirIds();
            $viewVars["allRolesMonitpringsAndTheirIds"] = $allRolesMonitpringsAndTheirIds;

            //
            $viewVars["user"] = $userEntity;

            //Token
            $token = md5(rand(1, 10000000));
            $session->set('_token', $token);
            $viewVars["_token"] = $token;

            //Command to render
            return $this->render("NdrmAuthBundle:Role:userRoles.html.twig"
                            , $viewVars);
        }
    }

}
