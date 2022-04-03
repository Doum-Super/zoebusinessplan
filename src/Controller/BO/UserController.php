<?php

namespace App\Controller\BO;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/administrators", name="administrator_list")
     * @Route("/customers", name="customer_list")
     */
    public function index(UserRepository $userRepository, Request $request): Response
    {
        switch($request->get('_route')) {
            case 'bo_administrator_list':
                $role = 'ROLE_ADMIN';
                $type = 'administrator';
                break;
            case 'bo_customer_list':
                $role = 'ROLE_CUSTOMER';
                $type = 'customer';
                break;
            default:
                $role = 'ROLE_ADMIN';
                $type = 'administrator';
                break;
        }
        return $this->render('bo/user/index.html.twig', [
            'users' => $userRepository->findUsersByRole($role),
            'type' => $type
        ]);
    }
}
