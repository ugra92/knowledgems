<?php
namespace AppBundle\Entity\Repository;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;


class UserRepository extends EntityRepository
{
    public function findByPk($id)
    {
      return $this->findOneById($id);
    }

    public function save(User $user){
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function employeesNoDepartment(){
        return  $this->findBy(array('departmentId'=> NULL));
    }
}