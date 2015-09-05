<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class PostController extends Controller
{

    /**
     * @Route("/posts", name="posts-main")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getManager()->getRepository('AppBundle:Post')->findAll();
        return $this->render('Dashboard/posts.html.twig', array('posts'=>$posts));
    }






}
