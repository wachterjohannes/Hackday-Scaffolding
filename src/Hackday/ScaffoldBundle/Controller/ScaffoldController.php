<?php

namespace Hackday\ScaffoldBundle\Controller;

use Hackday\ScaffoldBundle\Form\ScaffoldType;
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
     * @return mixed
     */
    protected abstract function getEntityObject();

    /**
     * @Route("/index")
     * @Template("HackdayScaffoldBundle:Scaffold:index.html.twig")
     */
    public function indexAction()
    {
        $definitions = $this->getDefinitions();
        $routes = $this->getRoutes();
        $data = $this->getDoctrine()->getRepository($this->getEntityName())->findAll();

        return array('definitions' => $definitions['definitions'], 'primaryKey' => $definitions['pk'], 'name' => $routes->getController(), 'data' => $data, 'routes' => $routes);
    }

    /**
     * @Route("/add")
     * @Template("HackdayScaffoldBundle:Scaffold:add.html.twig")
     */
    public function addAction()
    {
        $definitions = $this->getDefinitions();
        $routes = $this->getRoutes();
        $data = $this->getEntityObject();
        $form = $this->createForm(new ScaffoldType($definitions, 'Add'), $data);

        if ($this->getRequest()->isMethod('POST')) {

            $form->submit($this->getRequest());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();

                // Redirect
                return $this->redirect($this->generateUrl($routes->getIndexPath()));
            }

        }

        return array('definitions' => $definitions['definitions'], 'primaryKey' => $definitions['pk'], 'name' => $routes->getController(), 'data' => $data, 'form' => $form->createView(), 'routes' => $routes);
    }

    /**
     * @Route("/view/{id}")
     * @Template("HackdayScaffoldBundle:Scaffold:view.html.twig")
     */
    public function viewAction($id)
    {
        $definitions = $this->getDefinitions();
        $routes = $this->getRoutes();
        $data = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        return array('definitions' => $definitions['definitions'], 'primaryKey' => $definitions['pk'], 'name' => $routes->getController(), 'data' => $data, 'routes' => $routes);
    }

    /**
     * @Route("/edit/{id}")
     * @Template("HackdayScaffoldBundle:Scaffold:edit.html.twig")
     */
    public function editAction($id)
    {
        $definitions = $this->getDefinitions();
        $routes = $this->getRoutes();
        $data = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);
        $form = $this->createForm(new ScaffoldType($definitions, 'Save'), $data);

        if ($this->getRequest()->isMethod('POST')) {

            $form->submit($this->getRequest());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                // Redirect
                return $this->redirect($this->generateUrl($routes->getViewPath(), array('id' => $id)));
            }

        }

        return array('definitions' => $definitions['definitions'], 'primaryKey' => $definitions['pk'], 'name' => $routes->getController(), 'data' => $data, 'form' => $form->createView(), 'routes' => $routes);
    }

    /**
     * @Route("/delete/{id}")
     * @Template("HackdayScaffoldBundle:Scaffold:delete.html.twig")
     */
    public function deleteAction($id)
    {
        $routes = $this->getRoutes();
        $data = $this->getDoctrine()->getRepository($this->getEntityName())->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();

        return $this->redirect($this->generateUrl($routes->getIndexPath()));
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

    private function getDefinitions($entityName = "", $primary = true)
    {
        if ($entityName == "") {
            $entityName = $this->getEntityName();
        }
        $metaData = $this->getDoctrine()->getManager()->getClassMetadata($entityName);

        $pk = '';
        $definitions = array();
        foreach ($metaData->fieldMappings as $name => $md) {
            $def = new FieldDefinition($name, $md);
            if ($def->getIsPrimaryKey()) $pk = $def->propertyName;
            $definitions[] = $def;
        }
        foreach ($metaData->associationMappings as $name => $md) {
            $def = new FieldDefinition($name, $md, true);
            if ($primary) {
                $def->setAssociationDefinition($this->getDefinitions($def->getClassName(), false)['definitions']);
            }
            $definitions[] = $def;
        }
        $result = array(
            'pk' => $pk,
            'definitions' => $definitions
        );
        return $result;
    }

    private function getRoutes()
    {
        return new ScaffoldPaths($this->getRequest()->attributes->get('_route'));
    }

}
