<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     */
    public function indexAction()
    {
        $categories =
            $this
                ->getDoctrine()
                ->getRepository(Category::class)
                ->findAll();

        return $this->render('default/index.html.twig',
            ['categories' => $categories]);
    }

    /**
     * @Route("/category/{id}", name="category_articles")
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listArticles($id)
    {
        $category = $this->getDoctrine()
                         ->getRepository(Category::class)
                         ->find($id);

        $articles = $category->getArticles()->toArray();

        return $this->render('articles/list.html.twig',
            ['articles' => $articles]);
    }

}
