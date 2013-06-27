<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 27.06.13
 * Time: 17:37
 * To change this template use File | Settings | File Templates.
 */

namespace Hackday\ScaffoldBundle\Util;


class FieldDefinition
{

    var $propertyName;

    var $metaData;

    public function __construct($name, $metaData)
    {
        $this->propertyName = $name;
        $this->metaData = $metaData;
    }

    public function getPropertyName(){
        return $this->propertyName;
    }

    public function getFieldName(){
        return $this->metaData['fieldName'];
    }

    public function getType(){
        return $this->metaData['type'];
    }
}