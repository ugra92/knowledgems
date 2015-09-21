<?php
namespace AppBundle\Entity\Manager;



use AppBundle\Entity\Link;
use AppBundle\Entity\Repository\LinkRepository;

class LinkManager {

    protected $repository;
    protected $categoryManager;

    /**
     * @param LinkRepository $repository
     * @param CategoryManager $categoryManager
     */
    public function __construct(LinkRepository $repository, CategoryManager $categoryManager){
        $this->repository= $repository;
        $this->categoryManager= $categoryManager;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function findLinkByPk($id){

        return $this->repository->findLinkByPk($id);
    }

    /**
     * @param $limit
     * @return array
     */
    public function findLinksLimited($limit){
        return $this->repository->findLinksLimited($limit);
    }

    /**
     * @param Link $link
     * @param $categoryId
     */
    public function saveLink(Link $link, $categoryId){
        $category= $this->categoryManager->getCategoryById($categoryId);
        $link->setCategoryId($category);
        $category->addLink($link);
        $this->repository->saveLink($link);
    }

}