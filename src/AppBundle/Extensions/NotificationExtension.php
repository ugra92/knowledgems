<?php

namespace AppBundle\Extensions;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Twig_Extension;
use AppBundle\Entity\Notification;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 5.9.2015
 * Time: 19:13
 */

class NotificationExtension extends \Twig_Extension{

    protected $doctrine;
    protected $context;
    public function __construct(RegistryInterface $doctrine, TokenStorage $context){
        $this->doctrine = $doctrine;
        $this->context = $context;


    }

    public function getName()
    {
        return "notification_extension";
    }

    public function getFunctions()
    {
        return array(
            'notifications' => new \Twig_Function_Method($this, 'notifications')
        );
    }


    public function notifications(){
        $user =  $this->context->getToken()->getUser();
        return $this->doctrine->getRepository('AppBundle:Notification')->getNotifications($user);

    }

}