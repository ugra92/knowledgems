<?php
namespace AppBundle\Entity\Repository;


use AppBundle\Entity\Link;
use Doctrine\ORM\EntityRepository;


class LinkRepository extends EntityRepository
{

    const ALIAS = 'l';

    public function findByName($name)
    {

    }

    /**
     * @return array
     */
    public function findAllNoRelation(){
        $qb =$this->createQueryBuilder('v');
        $qb->select('l.linkId', 'l.heading', 'l.description', 'l.link', 'l.createdAt', 'l.tags')
            ->orderBy('l.createdAt', 'DESC');
        return $qb->getQuery()->getResult();
    }

    /**
     * @param $limit
     * @return array
     */
    public function findLinksLimited($limit){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('l')
            ->from('AppBundle:Link', 'l')
            ->orderBy('l.createdAt', 'DESC')
            ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Link $link
     */
    public function saveLink(Link $link){
        $this->_em->persist($link);
        $this->_em->flush();

    }

    public function findLinkByPk($id){

        return $this->findOneByLinkId($id);
    }

}