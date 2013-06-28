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
    private $submitText;

    public function __construct($definitions = array(), $submit = "Save")
    {
        $this->definitions = $definitions;
        $this->submitText = $submit;
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
            // TODO Other Types
                if ($def->getType() == "datetime") {
                    $builder->add($def->getPropertyName(), 'datetime', array(
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy H:m'
                    ));
                } else if ($def->getType() == "date") {
                    $builder->add($def->getPropertyName(), 'date', array(
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'attr' => array('class' => 'jqueryDatepicker')
                    ));
                } else if ($def->getType() == "time") {
                    $builder->add($def->getPropertyName(), 'time', array(
                        'widget' => 'single_text',
                        'format' => 'H:m'
                    ));
                } else {
                    $builder->add($def->getPropertyName());
                }
            }
        }

        $builder->add($this->submitText, 'submit');
    }
}