<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $articles = $this->get('article_manager')->findArticlesLimited(4);
        $videos = $this->get('video_manager')->findVideosLimited(4);
//        $comments=$this->getDoctrine()->getRepository('AppBundle:Comment')->findBy(array('userId'=>3));
//        $user = $this->get('security.token_storage')->getToken()->getUser();


        return $this->render(':Dashboard:index.html.twig', array('articles'=>$articles, 'videos'=>$videos));
    }
}
