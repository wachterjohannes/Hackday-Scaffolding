<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 28.06.13
 * Time: 10:01
 * To change this template use File | Settings | File Templates.
 */

namespace Hackday\ScaffoldBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ScaffoldType extends AbstractType
{
    private $definitions = array();

    public function __construct($definitions = array())
    {
        $this->definitions = $definitions;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "Scaffold";
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var $def \Hackday\ScaffoldBundle\Util\FieldDefinition */
        foreach ($this->definitions as $def) {
            if (!$def->getIsPrimaryKey()) {
                $builder->add($def->getPropertyName());
            }
        }

        // TODO Text as Parameter (Add, Edit)
        $builder->add('Save', 'submit');
    }
}