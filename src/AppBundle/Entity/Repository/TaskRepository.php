<?php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use Doctrine\ORM\EntityRepository;


class TaskRepository extends EntityRepository
{
    public function findByPk($id)
    {
       return $this->findOneById($id);
    }

    public function removeTask($task){
         $this->_em->remove($task);
        $this->_em->flush();

    }

    public function saveTask(Task $task){
        $this->_em->persist($task);
        $this->_em->flush();
    }


}