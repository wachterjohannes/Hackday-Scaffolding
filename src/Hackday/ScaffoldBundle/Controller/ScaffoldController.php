<?php

namespace Hackday\ScaffoldBundle\Controller;

use Hackday\ScaffoldBundle\Util\FieldDefinition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

abstract class ScaffoldController extends Controller
{

    /**
     * @return string
     */
    protected abstract function getEntityName();

    /**
     * @Route("/index")
     * @Template("HackdayScaffoldBundle:Scaffold:index.html.twig")
     */
    public function indexAction()
    {
        $metaData = $this->getDoctrine()->getManager()->getClassMetadata($this->getEntityName());
        $definitions = array();
        foreach ($metaData->fieldMappings as $name => $md) {
            $definitions[] = new FieldDefinition($name, $md);
        }

        $data = $this->getDoctrine()->getRepository($this->getEntityName())->findAll();

        return array('definitions' => $definitions, 'data' => $data);
    }

    protected function debug($var, $die = true)
    {
        echo("<pre>");
        print_r($var);
        echo("</pre>");
        if ($die) {
            die();
        }
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
