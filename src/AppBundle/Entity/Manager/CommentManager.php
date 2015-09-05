<?php
namespace AppBundle\Entity\Manager;
use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentManager {

     protected $repository;
    protected $articleManager;

    public function __construct(CommentRepository $repository, ArticleManager $articleManager){
        $this->repository= $repository;
        $this->articleManager= $articleManager;

    }

     public function getComments($id){
        return $this->repository->getComments($id);
     }

    public function getUserComments($id){
        return $this->repository->getUserComments($id);
    }

     public function addComment(Comment $comment, $articleId){

         $articles = $this->articleManager->getArticle($articleId);
         $article = $articles[0];
         $comment->setArticleId($article);
         return $this->repository->addComment($comment);
     }

 }