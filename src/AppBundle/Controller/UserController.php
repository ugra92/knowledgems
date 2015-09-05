<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{

    /**
     * @Route("/profile/", name="profile")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function profileAction()
    {
        $user = $this->getUser();
        $articles= $this->get('article_manager')->findArticlesByUserLimited($user->getId(), 4);
        $codeSnippets = $this->get('code_manager')->findSnippetsByUserLimited($user->getId(), 4);
        return $this->render('User/user-profile.html.twig', array('user'=> $user, 'articles' => $articles, 'codeSnippets'=>$codeSnippets));
    }


    /**
     * @Route("/uploadPhoto/", name="profile_photo_upload")
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\Response
     */
    public function profilePhotoAction(Request $request)
    {
        $image = $request->files->get('image');
        $document = new Document();
        $document->setFile($image);
        $this->getUser()->setProfileImg($document);
        $document->setName($this->getUser()->getId().'_'.$image->getClientOriginalName());
        $document->upload();
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($document);
        $em->flush();
        return $this->redirectToRoute('profile', array());
    }






}
