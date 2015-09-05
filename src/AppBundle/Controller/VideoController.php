<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class VideoController extends Controller
{

    /**
     * @Route("/videos", name="video-main")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function indexAction()
    {
        $videos = $this->get('video_repository')->findAll();
        return $this->render('Video/video-main.html.twig', array('videos'=>$videos));
    }


    /**
     * @Route("/video/add", name="video-add")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function addNewAction()
    {
        $categories = $this->get('category_repository')->findAll();
        return $this->render('Video/video-add-new.html.twig', array('categories'=>$categories));
    }

    /**
     * @Route("/video/add", name="video-add-ajax")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("POST")
     */
    public function addNewAjaxAction(Request $request)
    {
        $video = new Video();
        $video->setHeading($request->get('title'));
        $video->setLink($request->get('link'));
        $video->setDescription($request->get('desc'));
        $video->setUserId($this->getUser());
        $catId = (int)$request->get('category');
        $video->setTags($request->get('tags'));
        if ($request->request->get('article')['privacy']=='internal'){
            $video->setPrivate(true);
        }
        else{
            $video->setPrivate(false);
        }
        $this->get('video_manager')->saveVideo($video, $catId);
        return new Response('Created video '.$video->getHeading());
    }



}
