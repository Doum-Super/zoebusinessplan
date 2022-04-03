<?php

namespace App\Controller\BO;

use App\Entity\BPModel;
use App\Entity\BPModelRole;
use App\Form\BPModelRoleType;
use App\Form\BPModelType;
use App\Repository\BPModelRepository;
use App\Repository\BPModelRoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class BPModelRoleController extends AbstractController
{
    /**
     * @Route("/bp-model-roles", name="bp_model_role_list")
     */
    public function index(BPModelRoleRepository $bPModelRoleRepository): Response
    {
        return $this->render('bo/bp_model_role/index.html.twig', [
            'bpModelRoles' => ($this->isGranted('ROLE_SUPER_ADMIN')) ? $bPModelRoleRepository->findAll() : [],
        ]);
    }

    /**
     * @Route("/bp-model-role/new", name="bp_model_role_new")
    */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bpModelRole = new BPModelRole();
        $form = $this->createForm(BPModelRoleType::class, $bpModelRole);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($bpModelRole);
            $entityManager->flush($bpModelRole);

            $this->addFlash('bp_model_role_added', 'Ajout effectué');
            return $this->redirectToRoute('bo_bp_model_role_list');
        }


        return $this->render('bo/bp_model_role/new.html.twig', [
            'form' => $form->createView(),
            'currentRouteName' => $request->get('_route')
        ]);
    }

    /**
     * @Route("/bp-model-role/edit/{id}", name="bo_model_role_edit")
    */
    public function edit(Request $request, EntityManagerInterface $entityManager, BPModelRole $bpModelRole): Response
    {
        if (null === $bpModelRole) throw new NotFoundHttpException("Cette page n'existe pas");

        $form = $this->createForm(BPModelRoleType::class, $bpModelRole);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            $this->addFlash('bp_model_role_edited', 'Mise à jour effectuée');
            return $this->redirectToRoute('bo_bp_model_role_list');
        }

        return $this->render('bo/bp_model_role/edit.html.twig', [
            'form' => $form->createView(),
            'currentRouteName' => $request->get('_route'),
            'bpModelRole' => $bpModelRole
        ]);
    }

    /**
     * @Route("/bp-model-role/delete/{id}", name="bp_model_role_delete")
    */
    public function delete(Request $request, EntityManagerInterface $entityManager, BPModelRole $bpModelRole): Response
    {
        if (null === $bpModelRole) throw new NotFoundHttpException("Cette page n'existe pas");

        $entityManager->remove($bpModelRole);
        $entityManager->flush();

        $this->addFlash('bp_model_role_deleted', 'Suppression effectuée');
        return $this->redirectToRoute('bo_bp_model_role_list');
    }
}
