<?php

namespace Ndrm\ConceptBundle\Controller;

use Ndrm\ConceptBundle\Entity\Category\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Ndrm\ConceptBundle\Entity\Instance;
use \Ndrm\ConceptBundle\Form\Instance\InstanceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ndrm\ConceptBundle\Entity\Instance\ParamValue;
use \Ndrm\LocationBundle\Entity\Location;

/**
 * Description of CategorreyController
 *
 * @author root
 * @Route("/instance")
 */
class InstanceController extends Controller {

    const PATH_TO_CRUD_VIEWS = "NdrmConceptBundle:Instance/Crud:";
    const PATH_TO_Entity = "NdrmConceptBundle:Category/Category";

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * paginated instances of a category
     * @Route("/list/{conceptCategory}", name="concept_instance_list")
     * @Method({"GET"})
     */
    public function listAction(Category $conceptCategory) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();
        $instanceEntities = $em->getRepository(Instance::class)->findBy(array("conceptCategory" => $conceptCategory->getId())
                , array("lastUpdated" => "DESC"));
        return $this->render(self::PATH_TO_CRUD_VIEWS . "list.html.twig"
                        , array("instances" => $instanceEntities));
    }

    /**
     * Everyone can create an action
     * @Route("/create/{conceptCategory}", name="concept_instance_create")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request
    , Category $conceptCategory
    , UserInterface $user) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw $this->createAccessDeniedException();
        }
        $instanceEntity = new Instance();

        //Setting the concept from which the instance is driven out
        $instanceEntity->setConceptCategory($conceptCategory);

        //Setting the empty param_values 
        $em = $this->getDoctrine()->getManager();
        $paramValueRepo = $em->getRepository(ParamValue::class);
        $paramValueArrayCollection = $paramValueRepo->createParamValuesByConceptCategoryParams($conceptCategory);
        $instanceEntity->setParamValues($paramValueArrayCollection);

        //Setting the logged user as the user who logged in as the instance's creator
        $instanceEntity->setUser($user);

        //Set iran as the location for which the instance is created to be sold
        $locRepo = $em->getRepository(Location::class);
        //@todo find a strategy to select this location out of location tree
        $location = $locRepo->find(2);
        $instanceEntity->setLocation($location);

        $instanceForm = $this->createForm(InstanceType::class
                , $instanceEntity
        );

        $instanceForm->handleRequest($request);
        if ($instanceForm->isSubmitted() && $instanceForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($instanceEntity);
            $em->flush();
            return $this->redirectToRoute('/');
        }
        return $this->render(self::PATH_TO_CRUD_VIEWS . "modify.html.twig"
                        , array("form" => $instanceForm->createView()));
    }

    /**
     * @Route("/{instance}/edit", name="concept_instance_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request
    , Instance $instance
    , UserInterface $user) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw $this->createAccessDeniedException();
        }
        $this->denyAccessUnlessGranted('edit', $instance);
        $instanceForm = $this->createForm(InstanceType::class
                , $instance
        );
//        $em = $this->getDoctrine()->getManager();
//        $paramValueRepo = $em->getRepository(ParamValue::class);
//        $pvals = $paramValueRepo->findBy(array("instance" => $instance));
//        dump($pvals);

        $instanceForm->handleRequest($request);
        if ($instanceForm->isSubmitted() && $instanceForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($instance);
            $em->flush();
            return $this->redirectToRoute('/');
        }
        return $this->render(self::PATH_TO_CRUD_VIEWS . "modify.html.twig"
                        , array("form" => $instanceForm->createView()));
    }

    /**
     * @Route("/{instance}/show", name="concept_instance_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Instance $instance) {
        
    }

    /**
     * @Route("/{conceptCategory}/create", name="concept_instance_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction() {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw $this->createAccessDeniedException();
        }
    }

}
