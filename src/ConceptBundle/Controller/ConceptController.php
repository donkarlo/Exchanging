<?php

namespace ConceptBundle\Controller;

use ConceptBundle\Entity\Concept;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Concept controller.
 *
 * @Route("concept")
 */
class ConceptController extends Controller {

    /**
     * Lists all concept entities.
     *
     * @Route("/", name="concept_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $concepts = $em->getRepository('ConceptBundle:Concept')->findAll();

        return $this->render('concept/index.html.twig', array(
                    'concepts' => $concepts,
        ));
    }

    /**
     * Creates a new concept entity.
     *
     * @Route("/new", name="concept_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $concept = new Concept();
        $form = $this->createForm('ConceptBundle\Form\ConceptType', $concept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($concept);
            $em->flush($concept);

            return $this->redirectToRoute('concept_show', array('id' => $concept->getId()));
        }

        return $this->render('concept/new.html.twig', array(
                    'concept' => $concept,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a concept entity.
     *
     * @Route("/{id}", name="concept_show")
     * @Method("GET")
     */
    public function showAction(Concept $concept) {
        $deleteForm = $this->createDeleteForm($concept);

        return $this->render('concept/show.html.twig', array(
                    'concept' => $concept,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing concept entity.
     *
     * @Route("/{id}/edit", name="concept_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Concept $concept) {
        $deleteForm = $this->createDeleteForm($concept);
        $editForm = $this->createForm('ConceptBundle\Form\ConceptType', $concept);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('concept_edit', array('id' => $concept->getId()));
        }

        return $this->render('concept/edit.html.twig', array(
                    'concept' => $concept,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a concept entity.
     *
     * @Route("/{id}", name="concept_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Concept $concept) {
        $form = $this->createDeleteForm($concept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($concept);
            $em->flush($concept);
        }

        return $this->redirectToRoute('concept_index');
    }

    /**
     * Creates a form to delete a concept entity.
     *
     * @param Concept $concept The concept entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Concept $concept) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('concept_delete', array('id' => $concept->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
