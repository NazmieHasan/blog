<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categories")
 *
 * Class CategoryController
 * @package AppBundle\Controller\Admin
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="admin_categories")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listCategories(){
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render("admin/categories/list.html.twig", ['categories' => $categories]);
    }
}
