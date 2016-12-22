<?php

namespace ConceptBundle\Controller\Param;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Param controller.
 *
 * @Route("param")
 */
class ParamController extends Controller {

    /**
     * Lists all param entities.
     *
     * @Route("/", name="param_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $params = $em->getRepository('ParamBundle:Param')->findAll();

        return $this->render('ParamBundle:Param/Crud:index.html.twig', array(
                    'params' => $params,
        ));
    }

    /**
     * Creates a new param entity.
     *
     * @Route("/new", name="param_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $param = new Param();
        $form = $this->createForm('ParamBundle\Form\ParamType', $param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($param);
            $em->flush($param);

            return $this->redirectToRoute('param_show', array('id' => $param->getId()));
        }

        return $this->render('ParamBundle:Param/Crud:new.html.twig', array(
                    'param' => $param,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a param entity.
     *
     * @Route("/{id}", name="param_show")
     * @Method("GET")
     */
    public function showAction(Param $param) {
        $deleteForm = $this->createDeleteForm($param);

        return $this->render('ParamBundle:Param/Crud:show.html.twig', array(
                    'param' => $param,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing param entity.
     *
     * @Route("/{id}/edit", name="param_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Param $param) {
        $deleteForm = $this->createDeleteForm($param);
        $editForm = $this->createForm('ParamBundle\Form\ParamType', $param);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('param_edit', array('id' => $param->getId()));
        }

        return $this->render('ParamBundle:Param/Crud:edit.html.twig', array(
                    'param' => $param,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a param entity.
     *
     * @Route("/{id}", name="param_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Param $param) {
        $form = $this->createDeleteForm($param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($param);
            $em->flush($param);
        }

        return $this->redirectToRoute('param_index');
    }

    /**
     * Creates a form to delete a param entity.
     *
     * @param Param $param The param entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Param $param) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('param_delete', array('id' => $param->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
