<?php
namespace AppBundle\Entity;
use AppBundle\Entity\Article;
use AppBundle\Entity\CodeSnippet;
use AppBundle\Entity\Task;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToOne;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 *
 */
class User extends BaseUser{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Department", inversedBy="employees")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="departmentId")
     */
    protected $departmentId;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="userId")
     */
    protected $articles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Video", mappedBy="userId")
     */
    protected $videos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CodeSnippet", mappedBy="userId")
     */
    protected $codeSnippets;

//    /**
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Document", mappedBy="userId")
//     */
//    protected $documents;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="userId")
     */
    protected $comments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Notification", mappedBy="user")
     */
    protected $notifications;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $position;

    /**
     * @OneToOne(targetEntity="Document")
     **/
    protected $profileImg;

    /**
     * @ManyToMany(targetEntity="Task", inversedBy="users")
     * @JoinTable(name="users_tasks")
     **/
    protected  $tasks;

    public function __construct()
    {
        parent::__construct();
        $this->comments= new ArrayCollection();
//        $this->documents= new ArrayCollection();
        $this->articles= new ArrayCollection();
        $this->videos= new ArrayCollection();
        $this->tasks= new ArrayCollection();
        $this->codeSnippets= new ArrayCollection();
        $this->notifications= new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param mixed $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }


    /**
     * @return mixed
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @param mixed $departmentId
     */
    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @return mixed
     */
    public function getCodeSnippets()
    {
        return $this->codeSnippets;
    }

    /**
     * @param mixed $codeSnippets
     */
    public function setCodeSnippets($codeSnippets)
    {
        $this->codeSnippets = $codeSnippets;
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

//    /**
//     * @return mixed
//     */
//    public function getDocuments()
//    {
//        return $this->documents;
//    }
//
//    /**
//     * @param mixed $documents
//     */
//    public function setDocuments($documents)
//    {
//        $this->documents = $documents;
//    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
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

    /**
     * @return mixed
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param mixed $notifications
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
    }



    /**
     * @return mixed
     */
    public function getProfileImg()
    {
        return $this->profileImg;
    }

    /**
     * @param mixed $profileImg
     */
    public function setProfileImg($profileImg)
    {
        $this->profileImg = $profileImg;
    }


    public function addSnippet(CodeSnippet $codeSnippet)
    {
        $codeSnippet->setUserId($this);
        $this->codeSnippets[] = $codeSnippet;
        return $this;
    }

    /**
     * @param Task $tasks
     * @return $this
     */
    public function addTask(Task $tasks)
    {
        $tasks->addUser($this);
        $this->tasks[] = $tasks;
        return $this;
    }

    /**
     * @param Task $tasks
     */
    public function removeTask(Task $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Add article
     *
     * @param Article $article
     * @return User
     */
    public function addArticle(Article $article)
    {
        $article->setUserId($this);
        $this->articles[] = $article;
        return $this;
    }

    /**
     * @param Article $article
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }


    /**
     * @param Video $video
     * @return $this
     */
    public function addVideo(Video $video)
    {
        $video->setUserId($this);
        $this->articles[] = $video;
        return $this;
    }

    /**
     * @param Video $video
     */
    public function removeVideo(Video $video)
    {
        $this->videos->removeElement($video);
    }



    /**
     * Add document
     *
     * @param \AppBundle\Entity\Document $document
     * @return User
     */
    public function addDocument(\AppBundle\Entity\Document $document)
    {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \AppBundle\Entity\Document $document
     */
    public function removeDocument(\AppBundle\Entity\Document $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     * @return User
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {
        $comment->setUserId($this);
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * Remove comments
     *
     * @param Comment $comment
     * @internal param Comment $comments
     */
    public function removeComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }
}
