<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class CommentController extends Controller
{

    /**
     * @Route("/json/add-comment", name="json-add-comment")
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("POST")
     */
    public function indexAction(Request $request)
    {
        $comment= new Comment();
        $user= $this->getUser();
        $user->addComment($comment);
        $comment->setUserId($this->getUser());
        $comment->setText($request->request->get('comment'));
        $articleId=$request->request->get('id');
//       var_dump($request->request->get('comment'));
//        exit;
        return  $this->get('comment_manager')->addComment($comment, $articleId);
    }

}
