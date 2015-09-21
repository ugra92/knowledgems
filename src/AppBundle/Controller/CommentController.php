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
        $articleId=$request->request->get('article');
        $videoId=$request->request->get('video');
        $linkId=$request->request->get('link');
        if($articleId != null){
            return  $this->get('comment_manager')->addCommentArticle($comment, $articleId);
        }else if($videoId != null){
            $videoId =  $request->request->get('video');
            return  $this->get('comment_manager')->addCommentVideo($comment, $videoId);
        }else if($linkId != null){
            return  $this->get('comment_manager')->addCommentLink($comment, $linkId);
        }
    }

}
