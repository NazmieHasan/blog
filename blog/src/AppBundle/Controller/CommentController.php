<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use AppBundle\Service\Articles\ArticleServiceInterface;
use AppBundle\Service\Comment\CommentServiceInterface;
use AppBundle\Service\Users\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends Controller
{
    /**
     * CommentController Constructor
     */
    private $articleService;

    /**
     * @var CommentServiceInterface
     */
    private $commentService;

    /**
     * @var UserServiceInterface
     */
    private $userService;


    public function __construct(
        ArticleServiceInterface $articleService,
        CommentServiceInterface $commentService,
        UserServiceInterface $userService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
        $this->userService = $userService;
    }


    /**
     * @Route("/comment/create/{id}", name="comment_create", methods={"POST"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function create(Request $request, $id)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $this->addFlash("message", "Коментарът е добавен успешно!");
        $this->commentService->create($comment, $id);

            return $this->redirectToRoute("article_view", ['id' => $id]);
    }


    /**
     * @Route("/user/{id}/message", name="user_message", methods={"GET"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function addUserMessage($id) {
        return $this->render("users/message.html.twig",
            [
                'user' => $this->userService->findOneById($id)
            ]);

    }


    /**
     * @param Request $request
     * @return Comment
     */
    public function fillEntity(Request $request): Comment
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        return $comment;
    }





}
