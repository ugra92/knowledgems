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
        $qb = $this->createQueryBuilder('c');
        $qb->select('c.css', 'c.html', 'c.js')
            ->where('c.codeSnippetId = ?1')
            ->setParameter('1', $id);
        return $qb->getQuery()->getResult();
    }
    public function saveCode($code){
        $this->_em->persist($code);
        $this->_em->flush();
    }

}