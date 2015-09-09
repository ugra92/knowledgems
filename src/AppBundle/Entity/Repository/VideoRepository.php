<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Video;
use Doctrine\ORM\EntityRepository;


class VideoRepository extends EntityRepository
{

    const ALIAS = 'v';

    public function findByName($name)
    {

    }

    /**
     * @return array
     */
    public function findAllNoRelation(){
        $qb =$this->createQueryBuilder('v');
        $qb->select('v.videoId', 'v.heading', 'v.description', 'v.link', 'v.createdAt', 'v.tags')
            ->orderBy('v.createdAt', 'DESC');
        return $qb->getQuery()->getResult();
    }

    /**
     * @param $limit
     * @return array
     */
    public function findVideosLimited($limit){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('v')
            ->from('AppBundle:Video', 'v')
            ->orderBy('v.createdAt', 'DESC')
            ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Video $video
     */
    public function saveVideo(Video $video){
        $this->_em->persist($video);
        $this->_em->flush();

    }

}