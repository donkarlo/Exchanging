<?php

namespace Ndrm\ConceptBundle\Controller\Param\Input;

use Ndrm\ConceptBundle\Entity\Param\Input\Lang;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The pre route to this bundle is concept
 * @Route("param/input/langs")
 */
class LangController extends Controller {

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * Lists all test entities.
     *
     * @Route("/", name="param_input_langs_list")
     * @Method("GET")
     */
    public function indexAction(): Response {

        $em = $this->getDoctrine()->getManager();

        $langs = $em->getRepository('NdrmConceptBundle:Param\Input\Lang')->findAll();

        return $this->render('NdrmConceptBundle:Param/Input/Lang/Crud:index.html.twig', array(
                    'langs' => $langs,
        ));
    }

    /**
     * Creates a new test entity.
     *
     * @Route("/new", name="lang_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request): Response {
        $lang = new Lang();
        $form = $this->createForm('Ndrm\ConceptBundle\Form\Param\Input\LangType', $lang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lang);
            $em->flush($lang);

            return $this->redirectToRoute('lang_show', array('id' => $lang->getId()));
        }

        return $this->render('NdrmConceptBundle:Param/Input/Lang/Crud:new.html.twig', array(
                    'lang' => $lang,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a test entity.
     *
     * @Route("/{id}/show", name="lang_show")
     * @Method("GET")
     */
    public function showAction(Lang $lang){
        $deleteForm = $this->createDeleteForm($lang);

        return $this->render('NdrmConceptBundle:Param/Input/Lang/Crud:show.html.twig', array(
                    'lang' => $lang,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a test entity.
     *
     * @param Test $lang The test entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lang $lang) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('test_delete', array('id' => $lang->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }
    
    /**
     * Displays a form to edit an existing test entity.
     *
     * @Route("/{id}/edit", name="lang_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lang $lang) {
        $deleteForm = $this->createDeleteForm($lang);
        $editForm = $this->createForm('Ndrm\ConceptBundle\Form\Param\Input\LangType', $lang);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lang_show', array('id' => $lang->getId()));
        }

        return $this->render('NdrmConceptBundle:Param/Input/Lang/Crud:edit.html.twig', array(
                    'lang' => $lang,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

}
