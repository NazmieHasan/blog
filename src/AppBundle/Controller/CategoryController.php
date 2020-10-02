<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\CategoryType;

class CategoryController extends Controller
{
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

        return $this->render('admin/categories/create.html.twig',
        ['form' => $form->createView()]);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_categories');
        }
    }
}