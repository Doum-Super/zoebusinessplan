<?php

namespace App\Controller\BO;

use App\Entity\BPModel;
use App\Entity\BPModelRole;
use App\Entity\CustomerBP;
use App\Form\CustomerBpType;
use App\Repository\BPModelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customer-bp-models", name="customer_bp_model_list")
     */
    public function index(BPModelRepository $bPModelRepository): Response
    {
        return $this->render('bo/customer/bp_model/index.html.twig', [
            'bpModels' => $bPModelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/customer-bp-model/configure/{id}", name="customer_bp_model_configure")
     */
    public function configure(Request $request, EntityManagerInterface $entityManagerInterface, BPModel $bpModel)
    {
        $bpModelByCustomer = $entityManagerInterface->getRepository(BPModelRole::class)->findBpModelByCustomer($bpModel->getId());

        $customerVariables = ($bpModelByCustomer !== null) ? $bpModelByCustomer->getVariables() : [];

        $customerBpModel = new CustomerBP();
        foreach ($customerVariables as $customerVariable) {
            $customerBpModel->addVariable($customerVariable);
        }

        $form = $this->createForm(CustomerBpType::class, $customerBpModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('bo/customer/bp_model/configure.html.twig', [
            'form' => $form->createView(),
            'customerBpModel' => $customerBpModel
        ]);
    }
}
