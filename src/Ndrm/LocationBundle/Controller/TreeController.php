<?php

namespace Ndrm\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ndrm\LocationBundle\Entity\Location;
use Ndrm\LocationBundle\Form\LocationType;

/**
 * @author root
 * @Route("/tree")
 */
class TreeController extends Controller {

    const PATH_TO_CRUD_VIEWS = "NdrmLocationBundle:Crud:";
    const PATH_TO_Entity = "NdrmLocationBundle:Location";

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
     * @Route("/show", name="location_tree_show")
     * @Method("GET")
     * @return Response
     */
    public function ShowTreeAction() {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(\Ndrm\LocationBundle\Entity\Location::class);

        /**
         * This will add a child
         */
        $childCloseClosure = function($node/* It is the entity */) {
            $childNodeCreationUrl = $this->get('router')->generate('location_tree_node_create', array(
                'parentNode' => $node['id']
            ));
            $childNodeEditUrl = $this->get('router')->generate('location_tree_node_edit', array(
                'nodeToEdit' => $node['id']
            ));
            return
                    '<ul>'
                    . '<li><a href="' . $childNodeCreationUrl . '">' . "Add child" . '</a></li>'
                    . '<li><a href="' . $childNodeEditUrl . '">' . "Edit" . '</a></li>'
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
        //Get the tree
        $htmlTree = $repo->childrenHierarchy(
                null
                , false
                , $options
        );
        if ($htmlTree === "") {
            $evm = new \Doctrine\Common\EventManager();
            $evm->addEventSubscriber(new \Gedmo\Tree\TreeListener());
            $everyWhere = new Location();
            $everyWhere->setTitle('EveryWhere');
            $em->persist($everyWhere);
            $em->flush();

            //Get the tree from database again
            $htmlTree = $repo->childrenHierarchy(
                    null
                    , false
                    , $options
            );
        }
        /**
         * 
         */
        return $this->render(self::PATH_TO_CRUD_VIEWS . "list.html.twig"
                        , array("htmlTree" => $htmlTree));
    }

    /**
     * @Route("/create-node/{parentNode}", name="location_tree_node_create")
     * @Method({"GET", "POST"})
     */
    public function createNodeAction(Request $request, Location $parentNode) {
        $node = new Location();
        $nodeForm = $this->createForm(LocationType::class, $node);
        $nodeForm->handleRequest($request);
        if ($nodeForm->isSubmitted() && $nodeForm->isValid()) {
            $node->setParent($parentNode);
            $em = $this->getDoctrine()->getManager();
            $em->persist($node);
            $em->flush();
            return $this->redirectToRoute('location_tree_show');
        }
        return $this->render(self::PATH_TO_CRUD_VIEWS . "createNode.html.twig"
                        , array("nodeForm" => $nodeForm->createView()));
    }

    /**
     * @Route("/edit-node/{nodeToEdit}", name="location_tree_node_edit")
     * @Method({"GET", "POST"})
     * @return Response
     */
    public function editNodeAction(Request $request, Location $nodeToEdit) {
        $nodeEditForm = $this->createForm(LocationType::class, $nodeToEdit);
        $nodeEditForm->handleRequest($request);
        if ($nodeEditForm->isSubmitted() && $nodeEditForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('location_tree_show');
        }
        return $this->render(self::PATH_TO_CRUD_VIEWS . "editNode.html.twig"
                        , array("nodeForm" => $nodeEditForm->createView()));
    }

}
