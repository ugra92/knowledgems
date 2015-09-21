<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 05.04.2015
 * Time: 15:47
 */

namespace AppBundle\Entity;
use AppBundle\Entity\Article;
use AppBundle\Entity\Link;
use AppBundle\Entity\Repository\CategoryRepository;
use AppBundle\Entity\Video;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CategoryRepository")
 *@ORM\Table(name="Category")
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="categoryId")
     */
    protected $articles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Video", mappedBy="categoryId")
     */
    protected $videos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Link", mappedBy="categoryId")
     */
    protected $links;

    function __construct()
    {
        $this->articles= new ArrayCollection();
        $this->videos= new ArrayCollection();
        $this->links= new ArrayCollection();
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
     * @return mixed
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param mixed $links
     */
    public function setLinks($links)
    {
        $this->links = $links;
    }




    /**
     * Add articles
     *
     * @param Article $articles
     * @return Category
     */
    public function addArticle(Article $articles)
    {
        $this->articles[] = $articles;
        $articles->setCategoryId($this);
        return $this;
    }

    /**
     * Remove articles
     *
     * @param Article $articles
     */
    public function removeArticle(Article $articles)
    {
        $this->articles->removeElement($articles);
    }


    /**
     * @param Video $videos
     * @return $this
     */
    public function addVideo(Video $videos)
    {
        $this->videos[] = $videos;
        $videos->setCategoryId($this);
        return $this;
    }

    /**
     * @param Video $videos
     */
    public function removeVideo(Video  $videos)
    {
        $this->videos->removeElement($videos);
    }

    /**
     * @param Link $link
     * @return $this
     */
    public function addLink(Link $link)
    {
        $this->links[] = $link;
        $link->setCategoryId($this);
        return $this;
    }

    /**
     * @param Link $link
     */
    public function removeLink(Link  $link)
    {
        $this->links->removeElement($link);
    }
}
