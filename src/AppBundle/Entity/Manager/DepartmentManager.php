<?php
namespace AppBundle\Entity\Manager;
use AppBundle\Entity\Repository\DepartmentRepository;
use AppBundle\Entity\User;

class DepartmentManager {

    protected $repository;

    public function __construct(DepartmentRepository $repository){
        $this->repository= $repository;

    }

    public function getDepartmentById($id){
        return $this->repository->findByPk($id);
    }

    public function save($department){
        $this->repository->save($department);
    }

    public function getAllDepartments(){
        return $this->repository->getAllDepartments();
    }

}