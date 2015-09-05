<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class CommentRepository extends EntityRepository
{

    public function getComments($id)
    {
        return $this->findByArticleId($id);
    }

    public function getUserComments($id){
        return $this->findByUserId($id);
    }

    public function addComment($comment){
        $this->_em->persist($comment);
        $this->_em->flush();
        $comment = json_encode($comment);
        return new  Response($comment);
    }

}