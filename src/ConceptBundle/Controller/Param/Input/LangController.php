<?php

namespace ConceptBundle\Controller\Param\Input;

use ConceptBundle\Entity\Param\Input\Lang;
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
     * @Route("/", name="lang_index")
     * @Method("GET")
     */
    public function indexAction(): Response {
                die("Iran is big");

        $em = $this->getDoctrine()->getManager();

        $langs = $em->getRepository('ConceptBundle:Param/Input:Lang')->findAll();

        return $this->render('ConceptBundle:Param/Input/Lang/Crud:index.html.twig', array(
                    'langs' => $langs,
        ));
    }

    /**
     * Creates a new test entity.
     *
     * @Route("/new", name="lang_show")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request): Response {
        $lang = new Lang();
//        $form = $this->createForm('ConceptBundle\Form\Param\Input:LangType', $lang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lang);
            $em->flush($lang);

            return $this->redirectToRoute('lang_show', array('id' => $lang->getId()));
        }

        return $this->render('ConceptBundle:Param/Input/Lang/Crud:new.html.twig', array(
                    'lang' => $lang,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a test entity.
     *
     * @Route("/{id}", name="lang_show")
     * @Method("GET")
     */
    public function showAction(Lang $lang): Response {
        $deleteForm = $this->createDeleteForm($lang);

        return $this->render('ConceptBundle:Param/Input/Lang/Crud:show.html.twig', array(
                    'lang' => $lang,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

}
