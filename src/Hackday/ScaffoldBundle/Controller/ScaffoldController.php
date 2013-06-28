<?php

namespace Hackday\ScaffoldBundle\Controller;

use Hackday\ScaffoldBundle\Util\FieldDefinition;
use Hackday\ScaffoldBundle\Util\ScaffoldPaths;
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
        $definitions = $this->getDefinitions();
        $routes = $this->getRoutes();
        $data = $this->getDoctrine()->getRepository($this->getEntityName())->findAll();

        return array('definitions' => $definitions, 'data' => $data, 'routes' => $routes);
    }

    /**
     * @Route("/add")
     * @Template("HackdayScaffoldBundle:Scaffold:add.html.twig")
     */
    public function addAction()
    {
    }

    /**
     * @Route("/view/{id}")
     * @Template("HackdayScaffoldBundle:Scaffold:view.html.twig")
     */
    public function viewAction($id)
    {
        $definitions = $this->getDefinitions();
        $routes = $this->getRoutes();
        $data = $this->getDoctrine()->getRepository($this->getEntityName())->findAll();

        return array('definitions' => $definitions, 'data' => $data, 'routes' => $routes);
    }

    /**
     * @Route("/edit/{id}")
     * @Template("HackdayScaffoldBundle:Scaffold:edit.html.twig")
     */
    public function editAction($id)
    {
    }

    /**
     * @Route("/delete/{id}")
     * @Template("HackdayScaffoldBundle:Scaffold:delete.html.twig")
     */
    public function deleteAction($id)
    {
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

    private function getDefinitions()
    {
        $metaData = $this->getDoctrine()->getManager()->getClassMetadata($this->getEntityName());
        $definitions = array();
        foreach ($metaData->fieldMappings as $name => $md) {
            $definitions[] = new FieldDefinition($name, $md);
        }
        foreach ($metaData->associationMappings as $name => $md) {
            // TODO Many2Many
            if ($md['type'] != 4) {
                $definitions[] = new FieldDefinition($name, $md, true);
            }
        }
        return $definitions;
    }

    private function getRoutes()
    {
        return new ScaffoldPaths($this->getRequest()->attributes->get('_route'));
    }

}
