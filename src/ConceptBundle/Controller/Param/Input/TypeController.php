<?php

namespace ConceptBundle\Controller\Param\Input;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * ParamInputTypeController
 *
 * @Route("param-input-type")
 */
class TypeController extends Controller {

    /**
     * Lists all paramInputType entities.
     *
     * @Route("/", name="param-input-type_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $paramInputTypes = $em->getRepository('ConceptBundle:ParamInputType')->findAll();

        return $this->render('paraminputtype/index.html.twig', array(
                    'paramInputTypes' => $paramInputTypes,
        ));
    }

    /**
     * Creates a new paramInputType entity.
     *
     * @Route("/new", name="param-input-type_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $paramInputType = new Paramhtmlinputtype();
        $form = $this->createForm('ParamBundle\Form\ParamInputTypeType', $paramInputType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paramInputType);
            $em->flush($paramInputType);

            return $this->redirectToRoute('param-input-type_show', array('id' => $paramInputType->getId()));
        }

        return $this->render('paraminputtype/new.html.twig', array(
                    'paramInputType' => $paramInputType,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paramInputType entity.
     *
     * @Route("/{id}", name="param-html-input-type_show")
     * @Method("GET")
     */
    public function showAction(ParamHtmlInputType $paramInputType) {
        $deleteForm = $this->createDeleteForm($paramInputType);

        return $this->render('paraminputtype/show.html.twig', array(
                    'paramInputType' => $paramInputType,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paramHtmlInputType entity.
     *
     * @Route("/{id}/edit", name="param-input-type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ParamHtmlInputType $paramInputType) {
        $deleteForm = $this->createDeleteForm($paramInputType);
        $editForm = $this->createForm('ConceptBundle\Form\ParamInputTypeType', $paramInputType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('param-input-type_edit', array('id' => $paramInputType->getId()));
        }

        return $this->render('paraminputtype/edit.html.twig', array(
                    'paramInputType' => $paramInputType,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paramHtmlInputType entity.
     *
     * @Route("/{id}", name="param-input-type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ParamInputType $paramInputType) {
        $form = $this->createDeleteForm($paramInputType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paramInputType);
            $em->flush($paramInputType);
        }

        return $this->redirectToRoute('param-input-type_index');
    }

    /**
     * Creates a form to delete a paramInputType entity.
     *
     * @param ParamInputType $paramInputType The paramInputType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParamInputType $paramInputType) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('param-input-type_delete', array('id' => $paramInputType->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
