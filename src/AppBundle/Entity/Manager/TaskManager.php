<?php
namespace AppBundle\Entity\Manager;
use AppBundle\Entity\Repository\TaskRepository;

class TaskManager {

    protected $repository;

    public function __construct(TaskRepository $repository){

        $this->repository= $repository;

    }

    public function findByPk($id){

        return $this->repository->findOneById($id);
    }

    public function removeTask($taskId){
        $task = $this->repository->findByPk($taskId);
        $this->repository->removeTask($task);
    }

    public function saveTask($task){
        $this->repository->saveTask($task);
    }

}