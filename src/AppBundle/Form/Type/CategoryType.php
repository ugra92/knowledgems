<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category_name', 'text', array('attr'=>array('class'=>'form-control', 'required'=>'required')))
            ->add('save', 'submit', array('attr'=>array('class'=>'btn btn-success waves-effect waves-light')));
    }

    public function getName()
    {
        return 'category';
    }
}