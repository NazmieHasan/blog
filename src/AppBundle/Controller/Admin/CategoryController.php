<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/create", name="admin_categories_create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createCategory(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_categories');
        }
        return $this->render('admin/categories/create.html.twig',
            ['form' => $form->createView()]);
    }

}
