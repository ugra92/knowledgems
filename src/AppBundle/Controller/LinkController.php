<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
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

    /**
     * @Route("/link/add", name="link-add")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function linkAddAction()
    {   $categories = $this->get('category_repository')->findAll();
        return $this->render(':Link:add-link.html.twig', array('categories'=>$categories));
    }

    /**
     * @Route("/link/add-ajax", name="link-add-ajax")
     * @param Request $request
     * @return string|Response
     */
    public function addNewAjaxAction(Request $request)
    {
        $link = new Link();
        $link->setHeading($request->get('title'));
        $link->setLink($request->get('link'));
        $link->setDescription($request->get('desc'));
        $link->setUserId($this->getUser());
        $catId = (int)$request->get('category');
        $link->setTags($request->get('tags'));
        if ($request->request->get('article')['privacy']=='internal'){
            $link->setPrivate(true);
        }
        else{
            $link->setPrivate(false);
        }
        $this->get('link_manager')->saveLink($link, $catId);
        return new Response('Created link '.$link->getHeading());
    }

    /**
     * @Route("/links/", name="link-main")
     * @return string|Response
     */
    public function mainVideoAction()
    {
        $links = $this->get('link_repository')->findAll();
        return $this->render(':Link:link-main.html.twig', array('links'=>$links));
    }

    /**
     * @Route("/link/{id}", name="link-single")
     * @param $id
     * @return string|Response
     */
    public function singleLinkAction($id)
    {
        $link = $this->get('link_repository')->findOneByLinkId($id);
        return $this->render('Link/link-single.html.twig', array('link'=>$link));
    }

}
