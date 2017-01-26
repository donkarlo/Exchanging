<?php

namespace Ndrm\ConceptBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Ndrm\ConceptBundle\Entity\Category\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of CategorreyController
 *
 * @author root
 * @Route("/testing")
 */
class TestCategoryController extends Controller {

    /**
     * @Route("/create-sample-tree")
     */
    public function indexAction() {
        $evm = new \Doctrine\Common\EventManager();
        $evm->addEventSubscriber(new \Gedmo\Tree\TreeListener());

        $em = $this->getDoctrine()->getManager();
        $food = new Category();
        $food->setTitle('AnotherFood');

        $fruits = new Category();
        $fruits->setTitle('Fruits');
        $fruits->setParent($food);

        $vegetables = new Category();
        $vegetables->setTitle('Vegetables');
        $vegetables->setParent($food);

        $carrots = new Category();
        $carrots->setTitle('Carrots');
        $carrots->setParent($vegetables);

        $em->persist($food);
        $em->persist($fruits);
        $em->persist($vegetables);
        $em->persist($carrots);
        $em->flush();

        return new \Symfony\Component\HttpFoundation\Response("Tree was created");
    }

    /**
     * @Route("/show-html-tree")
     */
    public function ShowTree() {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(\Ndrm\ConceptBundle\Entity\Category\Category::class);
        $htmlTree = $repo->childrenHierarchy(
                null, /* starting from root nodes */ false, /* false: load all children, true: only direct */ array(
            'decorate' => true,
            'representationField' => 'slug',
            'html' => true
                )
        );
        return new \Symfony\Component\HttpFoundation\Response($htmlTree);
    }

}
