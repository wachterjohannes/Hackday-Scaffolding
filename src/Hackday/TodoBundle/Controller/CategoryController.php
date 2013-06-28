<?php

namespace Hackday\TodoBundle\Controller;

use Hackday\ScaffoldBundle\Controller\ScaffoldController;
use Hackday\TodoBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class CategoryController
 *
 * @package Hackday\TodoBundle\Controller
 * @Route("/category")
 */
class CategoryController extends ScaffoldController
{
    /**
     * @return string
     */
    protected function getEntityName()
    {
        return "HackdayTodoBundle:Category";
    }

    /**
     * @return mixed
     */
    protected function getEntityObject()
    {
        $cat = new Category();
        return $cat;
    }


}
