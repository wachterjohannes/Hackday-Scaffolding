<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 27.06.13
 * Time: 18:15
 * To change this template use File | Settings | File Templates.
 */

namespace Hackday\ScaffoldBundle\Util;


class ScaffoldPaths
{
    /**
     * @var string
     */
    var $bundleName;
    /**
     * @var string
     */
    var $controllerName;
    /**
     * @var string
     */
    var $functionName;

    /**
     * @param string $bundleName
     * @param string $controllerName
     * @param string $functionName
     */
    function __construct($bundleName, $controllerName, $functionName)
    {
        $this->bundleName = $bundleName;
        $this->controllerName = $controllerName;
        $this->functionName = $functionName;
    }

    /**
     * @return string
     */
    public function getBundleName()
    {
        return $this->bundleName;
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return string
     */
    public function getFunctionName()
    {
        return $this->functionName;
    }
}