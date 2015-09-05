<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;


class ArticleRepository extends EntityRepository
{
    public function findByName($name)
    {

    }

    public function findArticlesLimited($limit){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('a')
            ->from('AppBundle:Article', 'a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

    public function getUserArticles($id){
        return $this->findByUserId($id);
    }

    public function save(Article $article){
        $this->_em->persist($article);
        $this->_em->flush();
    }

    public function getArticlesFiltered($sql){

        $con = $this->getEntityManager()->getConnection()->prepare($sql);
        $con->execute();
        return $con->fetchAll();
    }

    public function getArticle($id){
        return $this->findByArticleId($id);
    }


    public function findArticlesByUserLimited($id, $limit){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('a')
            ->from('AppBundle:Article', 'a')
            ->where('a.userId = ?1')
            ->orderBy('a.createdAt', 'DESC')
            ->setParameter('1', $id)
            ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
}