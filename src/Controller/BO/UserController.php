<?php

namespace App\Controller\BO;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
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

    /**
     * @Route("/administrator/add", name="add_administrator")
     * @Route("/customer/add", name="add_customer")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     */
    public function add(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $currentRouteName = $request->get('_route');

        $user = new User();
        switch ($currentRouteName)
        {
            case 'bo_add_administrator':
                $role = 'ROLE_ADMIN';
                $form = $this->createForm(UserType::class, $user);
                $redirectRoute = 'bo_administrator_list';
                $flashKey = 'customer_added';
                $defaultPlainPassword = 'admin';
                break;
            case 'bo_add_customer':
                $role = 'ROLE_CUSTOMER';
                $form = $this->createForm(UserType::class, $user);
                $redirectRoute = 'bo_customer_list';
                $flashKey = 'customer_added';
                $defaultPlainPassword = 'customer';
                break;
            default:
                throw new AccessDeniedException('Accès non autorisé');
                break;
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles([$role]);
            $plainPassword = ($form->get('plainPassword')->getData() !== null ) ? $form->get('plainPassword')->getData() : $defaultPlainPassword;
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plainPassword
            );
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash($flashKey, 'Utilisateur ajouté');
            return $this->redirectToRoute($redirectRoute);
        }

        return $this->render('bo/user/add.html.twig', [
            'form' => $form->createView(),
            'currentRouteName' => $currentRouteName
        ]);
    }
}
