<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DepartmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('save', 'submit', array('attr'=>array('class'=>'btn btn-success')));
    }

    public function getName()
    {
        return 'department';
    }
}