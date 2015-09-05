<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 05.04.2015
 * Time: 15:47
 */

namespace AppBundle\Entity;
use AppBundle\Entity\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CategoryRepository")
 *
 */
class Category {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $categoryId;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="articleId")
     */
    protected $articles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Video", mappedBy="videoId")
     */
    protected $videos;

    function __construct()
    {
        $this->articles= new ArrayCollection();
        $this->videos= new ArrayCollection();
    }

    

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
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
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param mixed $videos
     */
    public function setVideos($videos)
    {
        $this->videos = $videos;
    }



    function __toString()
    {
        return $this->name;
    }



    /**
     * Add articles
     *
     * @param \AppBundle\Entity\Article $articles
     * @return Category
     */
    public function addArticle(\AppBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
        $articles->setCategoryId($this);
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \AppBundle\Entity\Article $articles
     */
    public function removeArticle(\AppBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }


    /**
     * @param Video $videos
     * @return $this
     */
    public function addVideo(\AppBundle\Entity\Video $videos)
    {
        $this->videos[] = $videos;
        $videos->setCategoryId($this);
        return $this;
    }

    /**
     * @param Video $videos
     */
    public function removeVideo(\AppBundle\Entity\Video  $videos)
    {
        $this->videos->removeElement($videos);
    }
}
