<?php

namespace Ndrm\AuthBundle\Controller;

use Ndrm\AuthBundle\Entity\User;
use Ndrm\AuthBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The pre route to this bundle is concept
 * @Route("user")
 */
class UserController extends Controller {

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * Lists all test entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('NdrmAuthBundle:User')->findAll();

        return $this->render('NdrmAuthBundle:Crud:index.html.twig', array(
                    'users' => $users,
        ));
    }

    /**
     * Creates a new test entity.
     * The sign up form
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);

            return $this->redirectToRoute('users_show', array('id' => $user->getId()));
        }

        return $this->render('NdrmAuthBundle:Crud:new.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a test entity.
     * This is actually the profile
     * @Route("/{id}/show", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user): Response {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('NdrmAuthBundle:Crud:show.html.twig', array(
                    'user' => $user,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a test entity.
     *
     * @param Test $user The test entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('test_delete', array('id' => $user->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing test entity.
     * omit the password, reseting password has another action
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user) {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('NdrmAuthBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('users_show', array('id' => $user->getId()));
        }

        return $this->render('NdrmAuthBundle:Crud:edit.html.twig', array(
                    'user' => $user,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/reset-password", name="user_forgot_password")
     */
    public function resetPasswordAction() {
        
    }

}
