<?php

namespace Ndrm\ConceptBundle\Controller\Param;

use Ndrm\ConceptBundle\Entity\Param\Param;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Ndrm\ConceptBundle\Entity\Category\Category;
use Ndrm\ConceptBundle\Form\Param\ParamByConceptCategoryType;

/**
 * Param controller.
 *
 * @Route("param")
 */
class ParamController extends Controller {

    const PATH_TO_CRUD_VIEWS = "NdrmConceptBundle:Param/Crud:";
    const PATH_TO_Entity = "NdrmConceptBundle:Pram/Param";

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * Lists all param entities.
     *
     * @Route("/list-by-concept-category/{conceptCategory}"
     * , name="cancept_param_list_by_concept_category")
     * @Method("GET")
     */
    public function indexAction(Category $conceptCategory) {
        $em = $this->getDoctrine()->getManager();
        $params = $em->getRepository(\Ndrm\ConceptBundle\Entity\Param\Param::class)
                ->findByCatWithInputTypeTitle($conceptCategory->getId());
        return $this->render(self::PATH_TO_CRUD_VIEWS . 'index.html.twig', array(
                    'params' => $params,
                    'conceptCategory' => $conceptCategory
        ));
    }

    /**
     * Creates a new param entity.
     *
     * @Route("/new-by-concept-category/{conceptCategory}"
     * , name="concept_param_new_for_a_category")
     * @Method({"GET", "POST"})
     */
    public function newParamByConceptCatAction(Request $request, Category $conceptCategory) {
        $param = new Param();
        $param->setConceptCategory($conceptCategory->getId());
        $form = $this->createForm(ParamByConceptCategoryType::class
                , $param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $param->setInputType($form->get("inputType")->getData()->getId());
            $em->persist($param);
            $em->flush($param);
            return $this->redirectToRoute('cancept_param_list_by_concept_category'
                            , array('conceptCategory' => $conceptCategory->getId()));
        }
        return $this->render(self::PATH_TO_CRUD_VIEWS . 'new.html.twig', array(
                    'param' => $param,
                    'conceptCategory' => $conceptCategory,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a param entity.
     *
     * @Route("/{id}"
     * , name="param_show")
     * @Method("GET")
     */
    public function showAction(Param $param) {
        $deleteForm = $this->createDeleteForm($param);

        return $this->render(self::PATH_TO_CRUD_VIEWS . 'show.html.twig', array(
                    'param' => $param,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing param entity.
     *
     * @Route("/{id}/edit"
     * , name="param_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Param $param) {
        $deleteForm = $this->createDeleteForm($param);
        $editForm = $this->createForm(ParamByConceptCategoryType::class
                , $param);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('concept_param_new_for_a_category'
                    , array('conceptCategory' => $param->getConceptCategory()));
        }
        return $this->render(self::PATH_TO_CRUD_VIEWS . 'edit.html.twig', array(
                    'param' => $param,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Deletes a param entity.
     *
     * @Route("/{id}"
     * , name="param_delete")
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
