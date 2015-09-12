<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\DepartmentRepository")
 *@ORM\Table(name="Department")
 */
class Department{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $departmentId;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="departmentId")
     */
    protected $employees;

    /**
     * @return mixed
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param mixed $employees
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }



    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get departmentId
     *
     * @return integer 
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * Add employees
     *
     * @param \AppBundle\Entity\User $employees
     * @return Department
     */
    public function addEmployee(User $employees)
    {
        $this->employees[] = $employees;
        $employees->setDepartmentId($this);
        return $this;
    }

    /**
     * Remove employees
     *
     * @param \AppBundle\Entity\User $employees
     */
    public function removeEmployee(User $employees)
    {
        $this->employees->removeElement($employees);
    }
}
