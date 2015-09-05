<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;


class CategoryRepository extends EntityRepository
{
    public function findByPk($id)
    {
       return $this->findOneByCategoryId($id);
    }

    public function save(Category $category){
        $this->_em->persist($category);
        $this->_em->flush();
    }


}