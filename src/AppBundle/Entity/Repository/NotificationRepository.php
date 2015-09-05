<?php
namespace AppBundle\Entity\Repository;


use AppBundle\Entity\Notification;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;
use AppBundle\Entity\Article;


class NotificationRepository extends EntityRepository
{
    const ALIAS = "n";
    const ARTICLE_ALIAS = "a";

    /**
     * @param $id
     * @return mixed
     */
    public function findByPk($id)
    {
       return $this->findOneById($id);
    }


    /**
     * @param $notification
     */
    public function removeNotification($notification){
         $this->_em->remove($notification);
        $this->_em->flush();

    }

    /**
     * @param Notification $notification
     */
    public function saveNotification(Notification $notification){
        $this->_em->persist($notification);
        $this->_em->flush();
    }

    /**
     * @param User $user
     * @return array
     */
    public function getNotifications(User $user){
        $qb = $this->createQueryBuilder('n');
        $qb->leftJoin('n.article', 'a')
            ->where('a.userId = '.$user->getId())->andWhere('n.seen = 0');
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Notification $notification
     */
    public function seeNotification(Notification $notification){
        $notification->setSeen(1);
        $this->_em->persist($notification);
        $this->_em->flush();
    }

}