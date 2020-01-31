<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $articles =
            $this
                ->getDoctrine()
                ->getRepository(Article::class)
                ->findBy(
                    [],
                    [
                        'dateAdded' => 'DESC',
                        'viewCount' => 'DESC'
                    ]
                );


        return $this->render('default/index.html.twig',
            ['articles' => $articles]);
    }
}
