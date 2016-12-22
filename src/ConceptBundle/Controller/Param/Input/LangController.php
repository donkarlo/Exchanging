<?php

namespace ConceptBundle\Controller\Param\Input;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route('param-input-langs')
 */
class LangController extends Controller {

    /**
     * Lists all paramInputType entities.
     *
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction() {
        return new Response('Welcome to Symfony!');
    }
}
