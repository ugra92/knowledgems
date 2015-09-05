<?php
namespace AppBundle\Entity\Manager;
use AppBundle\Entity\Article;
use  AppBundle\Entity\Repository\ArticleRepository;

class ArticleManager {

    protected $repository;
    protected $categoryManager;

    public function __construct(ArticleRepository $repository, CategoryManager $categoryManager){
        $this->repository= $repository;
        $this->categoryManager= $categoryManager;

    }
    public function save(Article $article, $categoryId){
        $category= $this->getCategory($categoryId);
        $category->addArticle($article);
        $article->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        $this->repository->save($article);

    }

    public function findArticlesByUserLimited($id, $limit){
       return  $this->repository->findArticlesByUserLimited($id, $limit);
    }

    public function findArticlesLimited($limit){
        return $this->repository->findArticlesLimited($limit);
    }

    public function getUserArticles($id){
        return $this->repository->getUserArticles($id);
    }

    public function getCategory($id){
        return $this->categoryManager->getCategoryById($id);
    }

    public function getArticle($id){
        return $this->repository->getArticle($id);
    }

    public function  getArticlesFiltered($parameter){
        if($parameter==''){
            $parameters = '1=1';
        }
        else{
            $parameters [] = explode(',',$parameter);
            for ($i = 0; $i < count($parameters[0]); $i++) {
                $parameters[0][$i]= " category.name = '".$parameters[0][$i]."' OR ";
            }
            $parameters[0][count($parameters[0])-1]= '';
            $parameters= implode(" ",$parameters[0]);
            $parameters = substr($parameters, 0, -4);
        }
        $sql = "SELECT heading, content, articleId, createdAt, user.name FROM article INNER JOIN category ON article.category_id = category.categoryId INNER JOIN user ON article.user_id= user.id WHERE ".$parameters;
        return $this->repository->getArticlesFiltered($sql);

    }
}