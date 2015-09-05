<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * @Route("/category", name="category_main")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new CategoryType());
        $form->handleRequest($request);
        if($form->isValid()){
            $category = new Category();
            $category->setName($form['category_name']->getData());
            $this->get('category_manager')->save($category);
        }
        return $this->render('Category/category-main.html.twig', array('form'=>$form->createView()));
    }

}
