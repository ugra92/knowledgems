<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use AppBundle\Form\Type\CategoryType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class NotificationController extends Controller
{
    /**
     * @Route("/notification/see", name="notification_see")
     * @param Request $request
     * @return Response
     */
    public function seeNotification(Request $request)
    {

        $id = $request->request->get('id');
        $notification = $this->get('notification_repository')->findOneById($id);
//        var_dump($notification);exit;
        $this->get('notification_repository')->seeNotification($notification);
        return new JsonResponse('OK');
    }


}
