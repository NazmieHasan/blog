<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/users")
 *
 * Class UserController
 * @package AppBundle\Controller\Admin
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="admin_users")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listUsers(){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render("admin/users/list.html.twig", ['users' => $users]);
    }
}
