<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    /**
     * @Route("/articles", name="article-main")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function indexAction()
    {
        $articles = $this->get('article_repository')->findAll();
        $categories= $this->get('category_repository')->findAll();
        return $this->render('Article/article-all.html.twig', array('articles'=>$articles, 'categories'=> $categories));
    }


    /**
     * @Route("/article/add", name="article-add")
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function addNewAction()
    {
        $form = $this->createForm(new ArticleType());
        $categories= $this->get('category_repository')->findAll();

        return $this->render('Article/article-main.html.twig', array('form'=>$form->createView(), 'categories'=>$categories));
    }

    /**
     * @Route("/article/edit/{id}", name="article-edit")
     * @param $id
     * @return string|Response
     */
    public function editAction($id)
    {

        $article = $this->get('article_manager')->findByPk($id);

        $categories= $this->get('category_repository')->findAll();

        return $this->render('Article/article-edit.html.twig', array('article'=>$article, 'categories'=>$categories));
    }

    /**
     * @Route("/article/{id}", name="article-single")
     * @param $id
     * @return string|Response
     */
    public function singleArticleAction($id)
    {
        $article = $this->get('article_manager')->getArticle($id);
        $comments= $this->get('comment_manager')->getComments($id);

        return $this->render('Article/article-single.html.twig', array('article'=> $article, 'comments'=>$comments));
    }


    /**
     * @Route("/article/json/add", name="article-add-post")
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("POST")
     */
    public function articleAddNewAction(Request $request)
    {

        //create new article
        $article = new Article();
        // get heading and content from $_POST
        $article->setHeading($request->request->get('heading'));
        $article->setContent($request->request->get('content'));
        $article->setTags($request->request->get('tags'));

        if ($request->request->get('privacy')=='internal'){
            $article->setPrivate(true);
        }
        else{
            $article->setPrivate(false);
        }
        $article->setUserId($this->getUser());
        $categoryId= (int)$request->request->get('category');

        $this->get('article_manager')->save($article, $categoryId);

        return new Response('Created article '.$article->getHeading());
    }

    /**
     * @Route("/article/json/edit", name="article-edit-post")
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("POST")
     */
    public function articleEditAction(Request $request)
    {

        //create new article
        $article =$this->get('article_manager')->findByPk($request->request->get('id'));
        // get heading and content from $_POST
        $article->setHeading($request->request->get('heading'));
        $article->setContent($request->request->get('content'));
        $article->setTags($request->request->get('tags'));

        if ($request->request->get('privacy')=='internal'){
            $article->setPrivate(true);
        }
        else{
            $article->setPrivate(false);
        }
        $article->setUserId($this->getUser());
        $categoryId= (int)$request->request->get('category');

        $this->get('article_manager')->edit($article);


        return new Response('Edited article '.$article->getHeading());
    }

    /**
     * @Route("json/articles", name="json-articles-post")
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\Response
     * @Method("POST")
     */
    public function jsonArticlesAction(Request $request)
    {
        $parameters = $request->request->get('parameter');
        $response = $this->get('article_manager')->getArticlesFiltered($parameters);
       return new JsonResponse($response, 200);
    }



}
