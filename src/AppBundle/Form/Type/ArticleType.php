<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('heading', 'text', array('attr'=>array('class'=>'form-control')))
//            ->add('content', 'textarea', array('attr'=>array('class'=>'form-control textarea-reset jqtext', 'rows'=>'20')))
//            ->add('tags', 'text', array('attr'=>array('class'=>'form-control', 'placeholder'=>'Comma separated values')))
//            ->add('privacy', 'choice', array('choices'=> array('public' => 'Public', 'internal' => 'Internal'),'attr'=>array('class'=>'')))
//            ->add('Add Article', 'submit', array('attr'=>array('class'=>'btn btn-success')));
    }

    public function getName()
    {
        return 'article';
    }
}