<?php

namespace AppBundle\Controller;


use AppBundle\Entity\CodeSnippet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CodeController extends Controller
{
    /**
     * @Route("/code/{id}", name="code_main", requirements={
     *     "id": "\d+"})
     * @param $id
     * @return Response
     * @internal param Request $request
     */
    public function indexAction($id)
    {
        $code = $this->get('code_manager')->getCodeById($id);
        return $this->render('Code/code-main.html.twig', array('code'=>$code));
    }

    /**
     * @Route("/code/add", name="code_add")
     * @Method("GET")
     */
    public function codeAddAction()
    {

        return $this->render('Code/code-add.html.twig');
    }

    /**
     * @Route("/code/add", name="json-code-add")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function jsonCodeAddAction(Request $request)
    {
        $code= new CodeSnippet();
//        var_dump($request->request);
//        exit;
        $code->setUserId($this->getUser());
        $code->setHtml($request->request->get('htmlCode'));
        $code->setCss($request->request->get('cssCode'));
        $code->setJs($request->request->get('jsCode'));
        $code->setHeading($request->request->get('heading'));
        $code->setTags($request->request->get('tags'));
        $this->get('code_manager')->saveCode($code);
    }

    /**
     * @Route("/code/all", name="json-code-all")
     * @Method("GET")
     */
    public function allSnipppetsAction(){
        $codes = $this->get('code_manager')->getAllSnippets();
       return $this->render('Code/code-all.html.twig', array('codes'=>$codes));
    }

    /**
     * @Route("/codePreview/{id}", name="codePreview")
     * @Method("GET")
     */
    public function codePreviewAction($id){
        $code = $this->get('code_manager')->getCodeById($id);
        return $this->render('Code/codePreview.html.twig', array('code'=>$code));
    }

}
