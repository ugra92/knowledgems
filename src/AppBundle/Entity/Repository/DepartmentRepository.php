<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Article;
use AppBundle\Entity\Department;
use Doctrine\ORM\EntityRepository;


class DepartmentRepository extends EntityRepository
{
    public function findByPk($id)
    {
        return $this->findOneByDepartmentId($id);
    }

    public function getAllDepartments(){
        return $this->findAll();
    }

    public function save(Department $department){
        $this->_em->persist($department);
        $this->_em->flush();
    }


}