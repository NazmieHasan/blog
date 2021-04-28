<?php

namespace AppBundle\Controller;

use AppBundle\Service\Articles\ArticleServiceInterface;
use AppBundle\Service\Users\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var ArticleServiceInterface
     */
    private $articleService;

    public function __construct(
        UserServiceInterface $userService,
        ArticleServiceInterface $articleService)
    {
        $this->userService = $userService;
        $this->articleService = $articleService;
    }

    /**
     * @Route("/admin/index", name="admin_index")
     * @return Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/admin/articles", name="admin_articles", methods={"GET"})
     * @return Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     */
    public function articlesAction(){
        return $this->render('admin/articles.html.twig',
            [
                'articles' => $this->articleService->getAll()

            ]);
    }

    /**
     * @Route("/admin/users", name="admin_users", methods={"GET"})
     * @return Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     */
    public function usersAction()
    {
        return $this->render('admin/users.html.twig',
            [
                'users' => $this->userService->getAll()
            ]);
    }

}