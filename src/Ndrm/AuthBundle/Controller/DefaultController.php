<?php

namespace Ndrm\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NdrmAuthBundle:Default:index.html.twig');
    }
}
