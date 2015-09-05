<?php
namespace AppBundle\Entity\Manager;
use AppBundle\Entity\Repository\CategoryRepository;

 class CategoryManager {

     protected $repository;

    public function __construct(CategoryRepository $repository){
        $this->repository= $repository;

    }

     public function getCategoryById($id){
        return $this->repository->findByPk($id);
     }

     public function save($category){
         $this->repository->save($category);
     }
 }