<?php

namespace App\Controller\BO;

use App\Entity\Role;
use App\Form\RoleType;
use App\Helper\ControllerHelper;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends AbstractController
{
    use ControllerHelper;

     /**
     * @Route("/roles", name="role_list")
     * @param RoleRepository $roleRepository
     * @return Response
     */
    public function index(RoleRepository $roleRepository): Response
    {
        return $this->render('bo/role/index.html.twig', [
            'roles' => $roleRepository->findAll()
        ]);
    }

    /**
     * @Route("/role/add", name="add_role")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse|Response
     */
    public function add(Request $request, EntityManagerInterface $entityManager)
    {
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role->setCode('ROLE_'.strtoupper(str_replace(' ', '_', $this->stripAccents($role->getName()))));
            $entityManager->persist($role);
            $entityManager->flush();

            $this->addFlash('role_added', 'Role crée');
            return $this->redirectToRoute('bo_role_list');
        }

        return $this->render('bo/role/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/role/{id}/edit", name="edit_role")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param Role $role
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, Role $role)
    {
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('role_updated', 'Role mise à jour');
            return $this->redirectToRoute('bo_role_list');
        }

        return $this->render('bo/role/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/role/{id}/delete", name="delete_role")
     * @param EntityManagerInterface $entityManager
     * @param Role $role
     * @return RedirectResponse|Response
     */
    public function delete(EntityManagerInterface $entityManager, Role $role)
    {
        if (null === $role) throw new NotFoundHttpException("Cette page n'existe pas");

        if ($role->getUsers()->isEmpty()) {
            $entityManager->remove($role);
            $entityManager->flush();
            $this->addFlash('role_deleted', 'Role supprimé');
        } else {
            $this->addFlash('role_deletion_error', "Impossible de supprimer le role ".$role->getName());
            return $this->redirectToRoute('bo_role_list');
        }

        return $this->redirectToRoute('bo_role_list');
    }
}
