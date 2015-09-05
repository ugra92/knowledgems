<?php
namespace AppBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;


class CodeSnippetRepository extends EntityRepository
{


    public function findSnippetsByUserLimited($id, $limit){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('c')
            ->from('AppBundle:CodeSnippet', 'c')
            ->where('c.userId = ?1')
            ->orderBy('c.createdAt', 'DESC')
            ->setParameter('1', $id)
            ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

    public function getCodeById($id){
        return $this->findByCodeSnippetId($id);
    }
    public function saveCode($code){
        $this->_em->persist($code);
        $this->_em->flush();
    }

}