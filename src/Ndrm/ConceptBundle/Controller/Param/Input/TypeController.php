<?php

namespace Ndrm\ConceptBundle\Controller\Param\Input;

use Ndrm\ConceptBundle\Entity\Param\Input\Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Type controller.
 *
 * @Route("param_input_type")
 */
class TypeController extends Controller {

    /**
     * Lists all type entities.
     *
     * @Route("/", name="param_input_type_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('NdrmConceptBundle:Param\Input\Type')->findAll();

        return $this->render('NdrmConceptBundle:Param/Input/Type/Crud:index.html.twig', array(
                    'types' => $types,
        ));
    }

    /**
     * Creates a new type entity.
     *
     * @Route("/new", name="param_input_type_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $type = new Type();
        $form = $this->createForm('Ndrm\ConceptBundle\Form\Param\Input\TypeType', $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush($type);

            return $this->redirectToRoute('param_input_type_show', array('id' => $type->getId()));
        }

        return $this->render('NdrmConceptBundle:Param/Input/Type/Crud:new.html.twig', array(
                    'type' => $type,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a type entity.
     *
     * @Route("/{id}", name="param_input_type_show")
     * @Method("GET")
     */
    public function showAction(Type $type) {
        $deleteForm = $this->createDeleteForm($type);

        return $this->render('NdrmConceptBundle:Param/Input/Type/Crud:show.html.twig', array(
                    'type' => $type,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing type entity.
     *
     * @Route("/{id}/edit", name="param_input_type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Type $type) {
        $deleteForm = $this->createDeleteForm($type);
        $editForm = $this->createForm('Ndrm\ConceptBundle\Form\Param\Input\TypeType', $type);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('param_input_type_edit', array('id' => $type->getId()));
        }

        return $this->render('NdrmConceptBundle:Param/Input/Lang/Crud:edit.html.twig', array(
                    'type' => $type,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a type entity.
     *
     * @Route("/{id}", name="param_input_type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Type $type) {
        $form = $this->createDeleteForm($type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type);
            $em->flush($type);
        }

        return $this->redirectToRoute('param_input_type_index');
    }

    /**
     * Creates a form to delete a type entity.
     *
     * @param Type $type The type entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Type $type) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('param_input_type_delete', array('id' => $type->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
