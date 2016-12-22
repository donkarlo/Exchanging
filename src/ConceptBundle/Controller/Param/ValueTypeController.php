<?php

namespace ConceptBundle\Controller\Param;

use ParamBundle\Entity\ParamValueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Paramvaluetype controller.
 *
 * @Route("param-value-type")
 */
class ParamValueTypeController extends Controller
{
    /**
     * Lists all paramValueType entities.
     *
     * @Route("/", name="param-value-type_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paramValueTypes = $em->getRepository('ParamBundle:ParamValueType')->findAll();

        return $this->render('paramvaluetype/index.html.twig', array(
            'paramValueTypes' => $paramValueTypes,
        ));
    }

    /**
     * Creates a new paramValueType entity.
     *
     * @Route("/new", name="param-value-type_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $paramValueType = new Paramvaluetype();
        $form = $this->createForm('ParamBundle\Form\ParamValueTypeType', $paramValueType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paramValueType);
            $em->flush($paramValueType);

            return $this->redirectToRoute('param-value-type_show', array('id' => $paramValueType->getId()));
        }

        return $this->render('paramvaluetype/new.html.twig', array(
            'paramValueType' => $paramValueType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paramValueType entity.
     *
     * @Route("/{id}", name="param-value-type_show")
     * @Method("GET")
     */
    public function showAction(ParamValueType $paramValueType)
    {
        $deleteForm = $this->createDeleteForm($paramValueType);

        return $this->render('paramvaluetype/show.html.twig', array(
            'paramValueType' => $paramValueType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paramValueType entity.
     *
     * @Route("/{id}/edit", name="param-value-type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ParamValueType $paramValueType)
    {
        $deleteForm = $this->createDeleteForm($paramValueType);
        $editForm = $this->createForm('ParamBundle\Form\ParamValueTypeType', $paramValueType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('param-value-type_edit', array('id' => $paramValueType->getId()));
        }

        return $this->render('paramvaluetype/edit.html.twig', array(
            'paramValueType' => $paramValueType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paramValueType entity.
     *
     * @Route("/{id}", name="param-value-type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ParamValueType $paramValueType)
    {
        $form = $this->createDeleteForm($paramValueType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paramValueType);
            $em->flush($paramValueType);
        }

        return $this->redirectToRoute('param-value-type_index');
    }

    /**
     * Creates a form to delete a paramValueType entity.
     *
     * @param ParamValueType $paramValueType The paramValueType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParamValueType $paramValueType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('param-value-type_delete', array('id' => $paramValueType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
