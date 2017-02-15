<?php

namespace Ndrm\ConceptBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ndrm\ConceptBundle\Entity\Category\Category;
use Ndrm\ConceptBundle\Form\Category\Crud\CategoryType;

/**
 * Description of CategorreyController
 *
 * @author root
 * @Route("/category")
 */
class CategoryController extends Controller {

    const PATH_TO_CRUD_VIEWS = "NdrmConceptBundle:Category/Crud:";
    const PATH_TO_Entity = "NdrmConceptBundle:Category/Category";

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * 
     * @return Response
     */
    public function indexAction(): Response {
        return;
    }

    /**
     * @Route("/show-tree", name="concept_category_show_tree")
     * @Method("GET")
     * @return Response
     */
    public function ShowTreeAction(): Response {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(\Ndrm\ConceptBundle\Entity\Category\Category::class);

        /**
         * This will add a child
         */
        $childCloseClosure = function($node/* It is the entity */) {
            $childNodeCreationUrl = $this->get('router')->generate('concept_category_node_create', array(
                'parentCategory' => $node['id']
            ));

            $childNodeEditUrl = $this->get('router')->generate('concept_category_node_edit', array(
                'nodeToEdit' => $node['id']
            ));

            $childNodeParams = $this->get('router')->generate('cancept_param_list_by_concept_category', array(
                'conceptCategory' => intval($node['id'])
            ));

            $createInstance = $this->get('router')->generate('concept_instance_create', array(
                'conceptCategory' => intval($node['id'])
            ));

            $listInstances = $this->get('router')->generate('concept_instance_list', array(
                'conceptCategory' => intval($node['id'])
            ));

            return
                    '<ul>'
                    . '<li><a href="' . $childNodeCreationUrl . '">' . "add child" . '</a></li>'
                    . '<li><a href="' . $childNodeEditUrl . '">' . "edit" . '</a></li>'
                    . '<li><a href="' . $childNodeParams . '">' . "setting params" . '</a></li>'
                    . '<li><a href="' . $createInstance . '">' . "create instance" . '</a></li>'
                    . '<li><a href="' . $listInstances . '">' . "list instances" . '</a></li>'
                    . '</li>'
                    . "</ul>"
            ;
        };

        /**
         * 
         */
        $options = array(
            'decorate' => true,
            'html' => true,
            'rootOpen' => '<ul>',
            'rootClose' => '</ul>',
            'childOpen' => '<li>',
            'childClose' => $childCloseClosure,
        );
        /**
         * 
         */
        $htmlTree = $repo->childrenHierarchy(
                null
                , false
                , $options
        );
        /**
         * 
         */
        return $this->render(self::PATH_TO_CRUD_VIEWS . "list.html.twig"
                        , array("htmlTree" => $htmlTree));
    }

    /**
     * @Route("/create-node/{parentCategory}", name="concept_category_node_create")
     * @Method({"GET", "POST"})
     */
    public function createNodeAction(Request $request, Category $parentNode) {
        $node = new Category();
        $categoryForm = $this->createForm(CategoryType::class, $node);
        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $node->setParent($parentNode);
            $em = $this->getDoctrine()->getManager();
            $em->persist($node);
            $em->flush();
            return $this->redirectToRoute('concept_category_show_tree');
        }
        return $this->render(self::PATH_TO_CRUD_VIEWS . "createCategory.html.twig"
                        , array("categoryForm" => $categoryForm->createView()));
    }

    /**
     * @Route("/edit-node/{nodeToEdit}", name="concept_category_node_edit")
     * @Method({"GET", "POST"})
     * @return Response
     */
    public function editNodeAction(Request $request, Category $nodeToEdit) {
        $nodeEditForm = $this->createForm(CategoryType::class, $nodeToEdit);
        $nodeEditForm->handleRequest($request);
        if ($nodeEditForm->isSubmitted() && $nodeEditForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('concept_category_show_tree');
        }
        return $this->render(self::PATH_TO_CRUD_VIEWS . "editNode.html.twig"
                        , array("nodeEditForm" => $nodeEditForm->createView()));
    }

}
