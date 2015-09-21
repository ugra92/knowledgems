<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;


class ArticleRepository extends EntityRepository
{

    const ALIAS = 'a';

    /**
     * @param $name
     */
    public function findByName($name)
    {

    }

    /**
     * @param $limit
     * @return array
     */
    public function findArticlesLimited($limit){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select(self::ALIAS.'.articleId, '.self::ALIAS.'.heading, '.self::ALIAS.'.createdAt, '.self::ALIAS.'.content, '.self::ALIAS.'.tags')
            ->from('AppBundle:Article', 'a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserArticles($id){
        return $this->findByUserId($id);
    }

    /**
     * @param Article $article
     */
    public function save(Article $article){
        $this->_em->persist($article);
        $this->_em->flush();
    }

    /**
     * @param $sql
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getArticlesFiltered($sql){

        $con = $this->getEntityManager()->getConnection()->prepare($sql);
        $con->execute();
        return $con->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getArticle($id){
        return $this->findByArticleId($id);
    }

    /**
     * @param $id
     * @param $limit
     * @return array
     */
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

    public function edit($article){
        $this->_em->persist($article);
        $this->_em->flush();
    }
}