<?php

namespace App\Controller\BO;

use alhimik1986\PhpExcelTemplator\params\CallbackParam;
use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\setters\CellSetterStringValue;
use App\Entity\BPModel;
use App\Entity\BPModelRole;
use App\Entity\CustomerBP;
use App\Entity\CustomerVariable;
use App\Form\CustomerBpType;
use App\Helper\ControllerHelper;
use App\Repository\BPModelRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    use ControllerHelper;

    /**
     * @Route("/customer-bp-models", name="customer_bp_model_list")
     */
    public function index(BPModelRepository $bPModelRepository): Response
    {
        //dump($bPModelRepository->findMySubscriptionBp($this->getUser())); die;
        return $this->render('bo/customer/bp_model/index.html.twig', [
            'bpModels' => $bPModelRepository->findMySubscriptionBp($this->getUser()),
        ]);
    }

    /**
     * @Route("/customer-bp-model/configure/{id}", name="customer_bp_model_configure")
     */
    public function configure(Request $request, EntityManagerInterface $entityManager, BPModel $bpModel)
    {
        $bpModelByCustomer = $entityManager->getRepository(BPModelRole::class)->findBpModelByCustomer($bpModel->getId());

        $variables = ($bpModelByCustomer !== null) ? $bpModelByCustomer->getVariables() : [];

        $customerBpModel = $entityManager->getRepository(CustomerBP::class)->findOneBy([
            'bpModel' => $bpModel,
            'createdBy' => $this->getUser()
        ]);

        $customerBpModel = (null === $customerBpModel) ? new CustomerBP() : $customerBpModel;

        if (null === $customerBpModel->getId()) {
            foreach ($variables as $variable) {
                $customerVariable = new CustomerVariable();
                $customerVariable->setVariable($variable);
                //$customerVariable->setCustomerBp($customerBpModel);
                $customerBpModel->addCustomerVariable($customerVariable);
            }
        } /*else {
            $customerOldVariables = [];
            foreach ($customerBpModel->getVariables() as $variable) {
                $customerOldVariables [] = $variable->getName();
            }

            foreach ($bpModelByCustomer->getVariables() as $variable) {
                if (!in_array($variable->getName(), $customerOldVariables)) {
                    $customerBpModel->addVariable($variable);
                }
            }
        }*/

        $form = $this->createFormBuilder($customerBpModel);

        $form = $this->createForm(CustomerBpType::class, $customerBpModel, ['bpModel' => $bpModel, 'variables' => $customerBpModel->getCustomerVariables()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerBpModel->setBpModel($bpModel);
            $entityManager->persist($customerBpModel);
            $entityManager->flush();

            return $this->redirectToRoute('bo_customer_bp_model_list');
        } 

        return $this->render('bo/customer/bp_model/configure.html.twig', [
            'form' => $form->createView(),
            'customerBpModel' => $customerBpModel
        ]);
    }

    /**
     * @Route("/customer-bp-model/generate/{id}", name="customer_bp_model_generate")
     */
    public function generate(Request $request, EntityManagerInterface $entityManager, BPModel $bpModel): Response
    {
        $templateDir = __DIR__.'/../../../public/files/doc/';
        $inputFileName = $templateDir.$bpModel->getModelFile()->getFileName();
        //$inputFileName = $templateDir.$bpModel->getModelFile()->getFileName();

        $params = [];

        /**
         * Administrator variables set
         */
        foreach ($bpModel->getVariables() as $variable) {
            $params = array_merge($params, [$variable->getName() => new ExcelParam(CellSetterStringValue::class, $variable->getValue())]);
        }

        $customerBpModel = $entityManager->getRepository(CustomerBP::class)->findOneBy([
            'bpModel' => $bpModel,
            'createdBy' => $this->getUser()
        ]);

        /**
         * Customer variables set
         */
        //foreach ($bpModel->getCustomerBPs() as $customerBpModel) {
        if (null !== $customerBpModel) {
            foreach ($customerBpModel->getCustomerVariables() as $customerVariable) {
                $variable = $customerVariable->getVariable();
                $params = array_merge($params, [$variable->getName() => new ExcelParam(CellSetterStringValue::class, $variable->getValue())]);
            }

            $params = array_merge($params, ['{project_summary}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getProjectSummary())]);
            $params = array_merge($params, ['{project_description}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getProjectDescription())]);
            $params = array_merge($params, ['{market_description}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getMarketDescription())]);
            $params = array_merge($params, ['{business_name}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getBusinessName())]);
            $params = array_merge($params, ['{beneficiary_fullname}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getBeneficiaryLastName().' '.$customerBpModel->getBeneficiaryFirstName())]);
            $params = array_merge($params, ['{beneficiary_sex}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getBeneficiarySex())]);
            $params = array_merge($params, ['{beneficiary_marital_status}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getBeneficiaryMaritalStatus())]);
            $params = array_merge($params, ['{beneficiary_study_level}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getBeneficiaryStudyLevel())]);
            $params = array_merge($params, ['{beneficiary_phone_number}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getBeneficiaryPhoneNumber())]);
            $params = array_merge($params, ['{beneficiary_address}' => new ExcelParam(CellSetterStringValue::class, $customerBpModel->getBeneficiaryAddress())]);
        } 
        //}

        //dump($params); die;

        $filename = 'result.xlsx';
        $outputFileName = $templateDir.$filename;

        PhpExcelTemplator::saveToFile($inputFileName, $outputFileName, $params, [], []);
        //PhpExcelTemplator::outputToFile($inputFileName, $outputFileName, $params, [], []);

        $reader = IOFactory::createReaderForFile($outputFileName);
        //$reader->setReadDataOnly(true);
        $reader->setReadEmptyCells(false);
        $spreadsheet = $reader->load($outputFileName);

        
        $writer = new Html($spreadsheet);
        $writer->setSheetIndex(0);
        //$writer->setImagesRoot('http://zoebusinessplan.local/public/assets/bo');
        $writer->setEmbedImages(false);
        $hdr = $writer->generateHTMLHeader();
        //$sty = $writer->generateStyles(false);
        $newstyle = <<<EOF
        <style type='text/css'>
            table.sheet0 {
                margin: 3rem auto;
            }
            .gridlines td {
                border: 1px solid black;
                padding: 0.5rem;
            }
        </style>
        EOF;

        $header = $hdr; //preg_replace('@</head>@', "$newstyle\n</head>", $hdr);
        $data = $writer->generateSheetData();
        $footer = $writer->generateHTMLFooter();

        //$style = $writer->generateStyles();
        $style = "";

        //$response = $header.$data.$footer;
        $html = $data;

        /*echo $html;
        die;*/
        

        $crawler = new Crawler($html);
        //$crawler = $crawler->filter('body > div.scrpgbrk');
        $outputHtml = $crawler->filterXPath('descendant::body/div')->each(function(Crawler $node, $i) {
            //$element = $node->getNode($i);
            //$node->setAttribute('class', 'table');
            $html = str_replace('sheet0 gridlines', 'table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3', $node->html());
            return $html;
        });

        
        //dump($outputHtml);
        //die;
        /*$outputHtml = '';
        foreach ($crawler as $domElement) {
            //if ($crawler->matches('div.scrpgbrk')) {
                $outputHtml .= $crawler->html();
            //}          
        }*/

        return $this->render('bo/customer/bp_model/customer-bp.html.twig', [
            'content' => $outputHtml,
            'customerBpModel' => $customerBpModel,
            'style' => $style
        ]);
        
        //dump($outputHtml);
        //die;

        //$writer->save($templateDir."bp.html");

        //echo $response;

        //die;
    }
}
