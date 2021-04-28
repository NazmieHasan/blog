<?php

namespace AppBundle\Service\Comment;

use AppBundle\Entity\Comment;
use AppBundle\Repository\CommentRepository;
use AppBundle\Service\Articles\ArticleService;
use AppBundle\Service\Articles\ArticleServiceInterface;
use AppBundle\Service\Users\UserServiceInterface;
use Symfony\Component\HttpFoundation\Request;

class CommentService implements CommentServiceInterface
{

    /**
     * @var UserServiceInterface
     */
    private $userService;
    private $commmentRepository;
    private $articleService;

    public function __construct(
        CommentRepository  $commmentRepository,
        UserServiceInterface $userService,
        ArticleServiceInterface $articleService)
    {
        $this->commmentRepository = $commmentRepository;
        $this->userService = $userService;
        $this->articleService = $articleService;
    }

    /**
     * @param int $articleId
     * @return Comment[]
     */
    public function getAllByArticleId(int $articleId)
    {
        $article = $this->articleService->getOne($articleId);
        return $this
            ->commmentRepository
            ->findBy(['article' => $article], ['dateAdded' => 'DESC']);
    }

    public function getOne(): ?Comment
    {

    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @param int $articleId
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(Comment $comment, int  $articleId): bool
    {
        $comment
            ->setAuthor($this->userService->currentUser())
            ->setArticle($this->articleService->getOne($articleId));

            return $this->commmentRepository->insert($comment);
    }

}