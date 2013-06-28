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

    var $isAssociation;

    var $associationDefinition;

    public function __construct($name, $metaData, $isAssociation = false, $associationDefinition = array())
    {
        $this->propertyName = $name;
        $this->metaData = $metaData;
        $this->isAssociation = $isAssociation;
        $this->associationDefinition = $associationDefinition;
    }

    public function getPropertyName()
    {
        return $this->propertyName;
    }

    public function getFieldName()
    {
        return $this->metaData['fieldName'];
    }

    public function getType()
    {
        return $this->metaData['type'];
    }

    public function getAssociation()
    {
        return $this->isAssociation;
    }

    public function getForeignKey()
    {
        if ($this->getAssociation()) {
            // TODO Many2Many
            // Excluded Many2One
            if ($this->metaData['type'] != '4') {
                return $this->metaData['joinColumns'][0]['referencedColumnName'];
            }
        }
        return "";
    }

    public function getController()
    {
        if ($this->getAssociation()) {
            $tmp = explode('\\', $this->metaData['targetEntity']);
            return strtolower($tmp[sizeof($tmp) - 1]);
        }
        return "";
    }

    public function getAssociationType()
    {
        if ($this->getAssociation()) {
            return $this->metaData['type'];
        }
        return "";
    }

    public function getIsPrimaryKey()
    {
        if (isset($this->metaData['id']) && $this->metaData['id'] == '1') {
            return true;
        }
        return false;
    }

    public function getClassName()
    {
        if ($this->getAssociation()) {
            return $this->metaData['targetEntity'];
        }
        return "";
    }

    public function getAssociationDefinition()
    {
        return $this->associationDefinition;
    }

    public function setAssociationDefinition($associationDefinition)
    {
        $this->associationDefinition = $associationDefinition;
    }
}