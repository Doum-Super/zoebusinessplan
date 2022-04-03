<?php

namespace App\Controller\BO;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends AbstractController
{
    /**
     * @Route("/b/o/role", name="app_b_o_role")
     */
    public function index(): Response
    {
        return $this->render('bo/role/index.html.twig', [
            'controller_name' => 'RoleController',
        ]);
    }
}
