<?php

namespace Hackday\ScaffoldBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

abstract class ScaffoldController extends Controller
{
    /**
     * @Route("/index")
     * @Template("HackdayScaffoldBundle:Scaffold:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/add")
     * @Template()
     */
    public function addAction()
    {
    }

    /**
     * @Route("/edit")
     * @Template()
     */
    public function editAction()
    {
    }

    /**
     * @Route("/delete")
     * @Template()
     */
    public function deleteAction()
    {
    }

}
