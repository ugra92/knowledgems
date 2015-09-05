<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class LinkController extends Controller
{

    /**
     * @Route("/questions", name="questions-main")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('StackOverflow/stack-main.html.twig');
    }





}
