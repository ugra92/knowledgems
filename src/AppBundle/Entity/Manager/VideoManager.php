<?php
namespace AppBundle\Entity\Manager;
use AppBundle\Entity\Article;
use  AppBundle\Entity\Repository\ArticleRepository;
use AppBundle\Entity\Repository\VideoRepository;
use AppBundle\Entity\Video;

class VideoManager {

    protected $repository;
    protected $categoryManager;

    public function __construct(VideoRepository $repository, CategoryManager $categoryManager){
        $this->repository= $repository;
        $this->categoryManager= $categoryManager;

    }

    public function findVideoByPk($id){
        return $this->repository->findOneByVideoId($id);
    }

    /**
     * @param $limit
     * @return array
     */
    public function findVideosLimited($limit){
        return $this->repository->findVideosLimited($limit);
    }

    /**
     * @param Video $video
     * @param $categoryId
     */
    public function saveVideo(Video $video, $categoryId){
        $category= $this->categoryManager->getCategoryById($categoryId);
        $video->setCategoryId($category);
        $category->addVideo($video);
        $this->repository->saveVideo($video);
    }

}