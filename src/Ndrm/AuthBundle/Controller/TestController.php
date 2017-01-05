<?php

namespace Ndrm\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ndrm\AuthBundle\Entity\Role;
use Ndrm\AuthBundle\Entity\User;
use Ndrm\AuthBundle\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/test")
 */
class TestController extends Controller {

    /**
     * @Route("/test")
     */
    public function testAction() {
        return $this->render('NdrmAuthBundle:Test:test.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/testRoleRep")
     */
    public function testRepositories() {
        $em = $this->getDoctrine()->getManager();
        $userRolesRepository = new RoleRepository($em, Role::class);
        var_dump($userRolesRepository->getAllRolesAndTheirIds());
    }

    /**
     * @Route("/m2m")
     */
    public function testManyToMany() {
        $em = $this->getDoctrine()->getManager();
        $userRepo = $em->getRepository("NdrmAuthBundle:User");
        $user3 = $userRepo->find(3);
//        \Doctrine\Common\Util\Debug::dump($user3->getRoleObjects());
        \Doctrine\Common\Util\Debug::dump($user3->getRoles());
    }

    /**
     * @Route("/dup")
     */
    public function testDup() {
        $em = $this->getDoctrine()->getManager();
        $roleRepo = $em->getRepository("NdrmAuthBundle:Role");
        die($roleRepo->getAllMonitpringsAndTheirIds());
    }

}
