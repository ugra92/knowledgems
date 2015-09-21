<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Notification;
use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class NotificationListener implements EventSubscriber {




    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array('postPersist');
    }

    /**
     * @param EventArgs|LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args){


        $entity = $args->getObject();
        $em = $args->getObjectManager();

        if($entity instanceof Comment){
            if($entity->getArticleId() != null){
               if($entity->getUserId()->getId() != $entity->getArticleId()->getUserId()->getId()){
                   $n = new Notification();
                   $n->setUser($entity->getUserId())->setArticle($entity->getArticleId());
                   $em->persist($n);
                   $em->flush();
               }
            }else if($entity->getVideoId() != null){
                if($entity->getUserId()->getId() != $entity->getVideoId()->getUserId()->getId()){
                    $n = new Notification();
                    $n->setUser($entity->getUserId())->setVideo($entity->getVideoId());
                    $em->persist($n);
                    $em->flush();
                }
            }
            else if($entity->getLinkId() != null){

                if($entity->getUserId()->getId() != $entity->getLinkId()->getUserId()->getId()){
                    $n = new Notification();
                    $n->setUser($entity->getUserId())->setLink($entity->getLinkId());
                    $em->persist($n);
                    $em->flush();
                }
            }
        }

    }

}