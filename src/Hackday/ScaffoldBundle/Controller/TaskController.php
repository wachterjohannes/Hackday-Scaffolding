<?php

namespace Hackday\ScaffoldBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class TaskController
 * @package Hackday\ScaffoldBundle\Controller
 * @Route("/task")
 */
class TaskController extends ScaffoldController
{
    /**
     * @return string
     */
    protected function getEntityName()
    {
        return "HackdayScaffoldBundle:Task";
    }
}
