<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 27.06.13
 * Time: 20:33
 * To change this template use File | Settings | File Templates.
 */

namespace Hackday\ScaffoldBundle\Util;


class ScaffoldPaths
{

    var $route;
    var $namespace;
    var $bundle;
    var $controller;
    var $action;

    var $actions = array(
        'index' => 'index',
        'add' => 'add',
        'edit' => 'edit',
        'view' => 'view',
        'delete' => 'delete',
    );

    public function __construct($currentRoute)
    {
        $this->route = $currentRoute;

        $tmp = explode("_", $currentRoute);
        $this->namespace = $tmp[0];
        $this->bundle = $tmp[1];
        $this->controller = $tmp[2];
        $this->action = $tmp[3];
    }

    public function getRoute()
    {
        return $this->route;
    }

    private function getPath($action = "", $controller = "")
    {
        if ($action == "") {
            $action = $this->action;
        } else {
            $action = $this->actions[$action];
        }
        if ($controller == "") $controller = $this->controller;
        return $this->namespace . '_' . $this->bundle . '_' . $controller . '_' . $action;
    }

    public function getIndexPath($controller = "")
    {
        return $this->getPath('index', $controller);
    }

    public function getAddPath($controller = "")
    {
        return $this->getPath('add', $controller);
    }

    public function getEditPath($controller = "")
    {
        return $this->getPath('edit', $controller);
    }

    public function getViewPath($controller = "")
    {
        return $this->getPath('view', $controller);
    }

    public function getDeletePath($controller = "")
    {
        return $this->getPath('delete', $controller);
    }

    public function getController()
    {
        return $this->controller;
    }
}