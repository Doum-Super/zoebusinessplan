<?php

namespace App\Controller\BO;

use App\Entity\BPModel;
use App\Entity\BPModelRole;
use App\Form\BPModelType;
use App\Repository\BPModelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\setters\CellSetterStringValue;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BPModelController extends AbstractController
{
    /**
     * @Route("/bp-models", name="bp_model_list")
     */
    public function index(BPModelRepository $bPModelRepository): Response
    {
        return $this->render('bo/bp_model/index.html.twig', [
            'bpModels' => ($this->isGranted('ROLE_SUPER_ADMIN')) ? $bPModelRepository->findAll() : [],
        ]);
    }

    /**
     * @Route("/bp-model/new", name="bp_model_new")
    */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {


        /*$templateDir = __DIR__.'/../../File/';
        $inputFileName = $templateDir.'bp_model_v3.xlsx';

        $params = [
            '{price1}' => new ExcelParam(CellSetterStringValue::class, 20000),
            '{price2}' => new ExcelParam(CellSetterStringValue::class, 10000),
            '{price3}' => new ExcelParam(CellSetterStringValue::class, 1000),
            '{price4}' => new ExcelParam(CellSetterStringValue::class, 500),
        ];

        $filename = 'result.xlsx';
        $outputFileName = $templateDir.$filename;

        PhpExcelTemplator::saveToFile($inputFileName, $outputFileName, $params, [], []);
        //PhpExcelTemplator::outputToFile($inputFileName, $outputFileName, $params, [], []);

        $spreadsheet = IOFactory::load($outputFileName);
        $writer = new Html($spreadsheet);
        $writer->setSheetIndex(0);
        //$writer->setImagesRoot('http://zoebusinessplan.local/public/assets/bo');
        $writer->setEmbedImages(false);
        $hdr = $writer->generateHTMLHeader();
        $sty = $writer->generateStyles(false);
        $newstyle = <<<EOF
        <style type='text/css'>
            [style="page: page0"]:not(.scrpgbrk) {
                display: none;
            }
            table { marging-bottom: 5rem !important }
            td {
                padding: 1rem;
            }
        </style>
        EOF;

        echo preg_replace('@</head>@', "$newstyle\n</head>", $hdr);
        echo $writer->generateSheetData();
        echo $writer->generateHTMLFooter();

        //$writer->save($templateDir."05featuredemo.html");

        die('ok');*/


        $bpModel = new BPModel();
        $form = $this->createForm(BPModelType::class, $bpModel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($bpModel);
            $entityManager->flush($bpModel);

            $this->addFlash('bp_model_added', 'Nouveau modèle de Business Plan ajouté');
            return $this->redirectToRoute('bo_bp_model_list');
        }


        return $this->render('bo/bp_model/new.html.twig', [
            'form' => $form->createView(),
            'currentRouteName' => $request->get('_route'),
            'bpModel' => new BPModel()
        ]);
    }

    /**
     * @Route("/bp-model/edit/{id}", name="bp_model_edit")
    */
    public function edit(Request $request, EntityManagerInterface $entityManager, BPModel $bpModel): Response
    {
        if (null === $bpModel) throw new NotFoundHttpException("Cette page n'existe pas");

        $form = $this->createForm(BPModelType::class, $bpModel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            $this->addFlash('bp_model_edited', 'Modèle Business Plan mis à jour');
            return $this->redirectToRoute('bo_bp_model_list');
        }

        return $this->render('bo/bp_model/edit.html.twig', [
            'form' => $form->createView(),
            'currentRouteName' => $request->get('_route'),
            'bpModel' => $bpModel
        ]);
    }

    /**
     * @Route("/bp-model/delete/{id}", name="bp_model_delete")
    */
    public function delete(Request $request, EntityManagerInterface $entityManager, BPModel $bpModel): Response
    {
        if (null === $bpModel) throw new NotFoundHttpException("Cette page n'existe pas");

        $entityManager->remove($bpModel);
        $entityManager->flush();

        $this->addFlash('bp_model_deleted', 'Modèle Business Plan supprimé');
        return $this->redirectToRoute('bo_bp_model_list');
    }

    public function changeGridlines(string $html): string
    {
        return str_replace('{border: 1px solid black;}',
            '{border: 2px dashed red;}',
            $html);
    }

    /**
     * @Route("/bp-model/generate/{id}", name="bp_model_generate")
     */
    public function generate(Request $request, EntityManagerInterface $entityManager, BPModel $bpModel): Response
    {
        //$bpModels = $entityManager->getRepository(BPModel::class)->findBy([], ['id' => 'DESC'], 1, 0);
        //if (!empty($bpModels)) {

            //$bpModel = $bpModels[0];

            $formBuilder = $this->createFormBuilder();

            for ($i = 1; $i <= $bpModel->getVariableNumber(); $i++) {
                $formBuilder->add('var_'.$i, TextType::class, [
                    'label' => 'Variable_'.$i,
                    'attr' => ['class' => 'form-control', 'placeholder' => 'Variable_'.$i]
                ]);
            }

            $form = $formBuilder->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $templateDir = __DIR__.'/../../../public/files/doc/';
                $inputFileName = $templateDir.$bpModel->getModelFile()->getFileName();
                //$inputFileName = $templateDir.$bpModel->getModelFile()->getFileName();


               // dump($inputFileName); die;

                $params = [];

                for ($i = 1; $i <= $bpModel->getVariableNumber(); $i++) {
                    $params = array_merge($params, ['{var_'.$i.'}' => new ExcelParam(CellSetterStringValue::class, $form->get('var_'.$i)->getData())]);
                }

                //dump($params); die;

                $filename = 'result.xlsx';
                $outputFileName = $templateDir.$filename;

                PhpExcelTemplator::saveToFile($inputFileName, $outputFileName, $params, [], []);
                //PhpExcelTemplator::outputToFile($inputFileName, $outputFileName, $params, [], []);

                $reader = IOFactory::createReaderForFile($outputFileName);
                //$reader->setReadDataOnly(true);
                $reader->setReadEmptyCells(false);
                $spreadsheet = $reader->load($outputFileName);

                /*$sheet = $spreadsheet->getSheet(0); 
                $highestRow = $sheet->getHighestDataRow(); 
                $highestColumn = $sheet->getHighestDataColumn();
                for ($row = 2; $row <= $highestRow; $row++){ 
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                    if($this->isEmptyRow(reset($rowData))) { continue; } // skip empty row
                    // do something usefull
                }*/

            
                //$spreadsheet = IOFactory::load($outputFileName);
                
                $writer = new Html($spreadsheet);
                $writer->setSheetIndex(0);
                //$writer->setImagesRoot('http://zoebusinessplan.local/public/assets/bo');
                $writer->setEmbedImages(false);
                $hdr = $writer->generateHTMLHeader();
                $sty = $writer->generateStyles(false);
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

                $header = preg_replace('@</head>@', "$newstyle\n</head>", $hdr);
                $data = $writer->generateSheetData();
                $footer = $writer->generateHTMLFooter();

                $response = $header.$data.$footer;

                //$writer->save($templateDir."bp.html");

                echo $response;

                die;

                //$response = preg_replace('@</head>@', "$newstyle\n</head>", $hdr).$writer->generateSheetData().$writer->generateHTMLFooter();
                //echo $writer->generateSheetData();
                //echo $writer->generateHTMLFooter();

                //return new Response('');
            }
        //}

        return $this->render('bo/bp_model/generate.html.twig', [
            'form' => $form->createView(),
            'bpModel' => $bpModel
        ]);
    }

    public function isEmptyRow($row) {
        foreach($row as $cell){
            if (null !== $cell) return false;
        }
        return true;
    }
}
