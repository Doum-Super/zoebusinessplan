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
use App\Form\CustomerBPLightType;
use App\Form\CustomerBpType;
use App\Helper\ControllerHelper;
use App\Repository\BPModelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use PhpParser\Node\Stmt\TryCatch;
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

        if (null === $customerBpModel->getId() || $customerBpModel->getCustomerVariables()->isEmpty()) {
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
     * @Route("/customer-bp-model/setting/{id}", name="customer_bp_model_setting")
     * @Route("/customer-bp-model/generate/{id}", name="customer_bp_model_generate")
     */
    public function generate(Request $request, EntityManagerInterface $entityManager, BPModel $bpModel): Response
    {
        $params = [];

        /**
         * Administrator variables set
         */
        foreach ($bpModel->getVariables() as $variable) {
            $value = ($variable->getType() === 'number') ? (float) $variable->getValue() : $variable->getValue();
            $params = array_merge($params, ['{'.$variable->getName().'}' => new ExcelParam(CellSetterStringValue::class, $value)]);
        }

        $customerBpModel = $entityManager->getRepository(CustomerBP::class)->findOneBy([
            'bpModel' => $bpModel,
            'createdBy' => $this->getUser()
        ]);
        
        //dump($outputHtml);
        //die;
        /*$outputHtml = '';
        foreach ($crawler as $domElement) {
            //if ($crawler->matches('div.scrpgbrk')) {
                $outputHtml .= $crawler->html();
            //}          
        }*/

        $form = $this->createForm(CustomerBPLightType::class, $customerBpModel, ['bpModel' => $bpModel, 'variables' => $customerBpModel->getCustomerVariables()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush($customerBpModel);

            return $this->redirectToRoute('bo_customer_bp_model_generate');
        }

        $outputHtml = $this->generateHtml($customerBpModel, $bpModel, $params);
        $currentRouteName = $request->get('_route');
        $parameters = [
            'content' => $outputHtml,
            'customerBpModel' => $customerBpModel,
            'customerVariables' => $customerBpModel->getCustomerVariables(),
            'style' => ''
        ];

        if ($currentRouteName === 'bo_customer_bp_model_setting') {
            $parameters['form'] = $form->createView();
            return $this->render('bo/customer/bp_model/customer-bp.html.twig', $parameters);
        }

        return $this->render('bo/customer/bp_model/customer-bp-generate.html.twig', $parameters);
        
        //dump($outputHtml);
        //die;

        //$writer->save($templateDir."bp.html");

        //echo $response;

        //die;
    }

    public function generateHtml(CustomerBP $customerBpModel, BPModel $bpModel, array $params): array
    {
        $templateDir = __DIR__.'/../../../public/files/doc/';
        $inputFileName = $templateDir.$bpModel->getModelFile()->getFileName();
        //$inputFileName = $templateDir.$bpModel->getModelFile()->getFileName();

        /**
         * Customer variables set
         */
        //foreach ($bpModel->getCustomerBPs() as $customerBpModel) {
        if (null !== $customerBpModel) {
            foreach ($customerBpModel->getCustomerVariables() as $customerVariable) {
                $variable = $customerVariable->getVariable();
                $value = ($variable->getType() === 'number') ? (float) $customerVariable->getValue() : $customerVariable->getValue();
                $params = array_merge($params, ['{'.$variable->getName().'}' => new ExcelParam(CellSetterStringValue::class, $value)]);
            }

            $params = array_merge($params, ['{project_summary}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='projectSummary'></div>")]);
            $params = array_merge($params, ['{project_description}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='projectDescription'></div>")]);
            $params = array_merge($params, ['{material_resources}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='materialResource'></div>")]);
            $params = array_merge($params, ['{human_resources}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='humanResource'></div>")]);
            $params = array_merge($params, ['{realization_program}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='realizationProgram'></div>")]);
            $params = array_merge($params, ['{market_description}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='marketDescription'></div>")]);
            $params = array_merge($params, ['{working_capital_comment}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='workingCapitalComment'></div>")]);
            $params = array_merge($params, ['{financing_needs_comment}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='financingNeedsComment'></div>")]);
            $params = array_merge($params, ['{revenue_forecast_comment}' => new ExcelParam(CellSetterStringValue::class, "<div class='_text_editor_' id='revenueForecastComment'></div>")]);


            $params = array_merge($params, ['{business_name}' => new ExcelParam(CellSetterStringValue::class, "<div class='_input_text_' id='beneficiaryBusinessName'></div>")]);
            $params = array_merge($params, ['{beneficiary_fullname}' => new ExcelParam(CellSetterStringValue::class, "<div class='_input_text_' id='beneficiaryLastName'></div><div class='_input_text_' id='beneficiaryFirstName'></div>")]);
            
            $sex = ($customerBpModel->getBeneficiarySex() === 'male') ? 'Homme' : 'Femme';
            $params = array_merge($params, ['{beneficiary_sex}' => new ExcelParam(CellSetterStringValue::class, "<div class='_input_text_' id='beneficiarySex'></div>")]);
            
            $params = array_merge($params, ['{beneficiary_marital_status}' => new ExcelParam(CellSetterStringValue::class, "<div class='_input_text_' id='beneficiaryMaritalStatus'></div>")]);
            $params = array_merge($params, ['{beneficiary_study_level}' => new ExcelParam(CellSetterStringValue::class, "<div class='_input_text_' id='beneficiaryStudyLevel'></div>")]);
            $params = array_merge($params, ['{beneficiary_phone_number}' => new ExcelParam(CellSetterStringValue::class, "<div class='_input_text_' id='beneficiaryPhoneNumber'></div>")]);
            $params = array_merge($params, ['{beneficiary_address}' => new ExcelParam(CellSetterStringValue::class, "<div class='_input_text_' id='beneficiaryAddress'></div>")]);
            $params = array_merge($params, ['{beneficiary_ddn}' => new ExcelParam(CellSetterStringValue::class, "<div class='_input_text_' id='customerDateOfBirth'></div>")]);
        } 
        //}

        //dump($params); die;

        $filename = 'result.xlsx';
        $outputFileName = $templateDir.$filename;

        try {
            PhpExcelTemplator::saveToFile($inputFileName, $outputFileName, $params);
            //PhpExcelTemplator::outputToFile($inputFileName, $outputFileName, $params, [], []);
        } catch (Exception $e) {
            dump($e->getMessage());
            //die;
        }
        //PhpExcelTemplator::outputToFile($inputFileName, $outputFileName, $params, [], []);

        $reader = IOFactory::createReaderForFile($outputFileName);
        //$reader->setReadDataOnly(true);
        $reader->setReadEmptyCells(false);
        $spreadsheet = $reader->load($outputFileName);

        //$class = '\\App\\Controller\\BO\\CustomerController';
        //$method = 'changeGridlines';

        
        $writer = new Html($spreadsheet);
        //$writer->setPreCalculateFormulas(false);
        $writer->setSheetIndex(0);
        //$writer->setImagesRoot('http://zoebusinessplan.local/public/assets/bo');
        $writer->setEmbedImages(false);
        $hdr = $writer->generateHTMLHeader();
        $sty = $writer->generateStyles(false);
        $newstyle = <<<EOF
        <style type='text/css'>
            $sty
            table.sheet0 {
                margin: 3rem auto;
            }
            .gridlines td {
                border: 1px solid black;
                padding: 0.5rem;
            }
        </style>
        EOF;
        //td.style0 { display: none; }

        $header = preg_replace('@</head>@', "$newstyle\n</head>", $hdr);
        $data = $writer->generateSheetData();
        $footer = $writer->generateHTMLFooter();

        //$style = $writer->generateStyles();
        //$style = "";

        //$response = $header.$data.$footer;
        $html = $header.$data.$footer;

        //$pattern = '/(<td class="[a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z][0-9]+ style0">&nbsp;<\/td>)/';
        //$replacement = '';

        //dump($html);

        //$html = preg_replace($pattern, $replacement, $html);

        //dump($html); die;

        //echo $header;
        //echo $html;
        //echo $footer;
        //die;
        

        $crawler = new Crawler($html);
        //$crawler = $crawler->filter('body > div.scrpgbrk');
        $outputHtml = $crawler->filterXPath('descendant::body/div')->each(function(Crawler $node, $i) {
            //$element = $node->getNode($i);
            //$node->setAttribute('class', 'table');
            $html = str_replace('sheet0 gridlines', 'table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3', $node->html());
            return $html;
        });

        return $outputHtml;
    }
}
