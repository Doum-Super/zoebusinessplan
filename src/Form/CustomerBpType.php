<?php

namespace App\Form;

use App\Entity\BPModel;
use App\Entity\CustomerBP;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerBpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $bpModel = $options['bpModel'];
        $builder
            ->add('businessName', TextType::class, [
                'label' => "Raison sociale de l'entreprise",
                'attr' => ['class' => 'form-control', 'placeholder' => "Raison sociale de l'entreprise"],
                'required' => false
            ])
            ->add('projectDescription', TextareaType::class, [
                'label' => 'Description du projet',
                'attr' => ['class' => 'summernote', 'placeholder' => 'Description du projet', 'rows' => 20],
                'required' => false
            ])
            ->add('projectSummary', TextareaType::class, [
                'label' => 'Resumé du projet',
                'attr' => ['class' => 'summernote', 'placeholder' => 'Resumé du projet', 'rows' => 20],
                'required' => false
            ])
            ->add('beneficiaryFirstName', TextType::class, [
                'label' => 'Prénom du beneficiaire',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom du beneficiaire'],
                'required' => false
            ])
            ->add('beneficiaryLastName', TextType::class, [
                'label' => 'Nom du beneficiaire',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom du beneficiaire'],
                'required' => false
            ])
            ->add('beneficiarySex', ChoiceType::class, [
                'label' => 'Sexe du beneficiaire',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Sexe du beneficiaire'],
                'choices' => [
                    'Homme' => 'male',
                    'Femme' => 'female'
                ],
                //'required' => false
            ])
            ->add('beneficiaryMaritalStatus', TextType::class, [
                'label' => 'Situation matrimoniale du beneficiaire',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Situation matrimoniale'],
                'required' => false
            ])
            ->add('beneficiaryPhoneNumber', TextType::class, [
                'label' => 'Numéro du beneficiaire',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro du beneficiaire'],
                'required' => false
            ])
            ->add('beneficiaryAddress', TextType::class, [
                'label' => 'Adresse du beneficiaire',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse du beneficiaire'],
                'required' => false
            ])
            ->add('beneficiaryStudyLevel',  TextType::class, [
                'label' => "Niveau d'étude du beneficiaire",
                'attr' => ['class' => 'form-control', 'placeholder' => "Niveau d'étude du beneficiaire"],
                'required' => false
            ])
            ->add('marketDescription', TextareaType::class, [
                'label' => 'Description du marchet',
                'attr' => ['class' => 'summernote', 'placeholder' => 'Description du marchet', 'rows' => 20],
                'required' => false
            ])
            ->add('cover', ImageManagerType::class, [
                'label' => 'Image'
            ])
            ->add('bpModel', EntityType::class, [
                'label' => 'Modèle Business Modèle',
                'class' => BPModel::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control', 'placeholder']
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($bpModel) {
                $customerBp = $event->getData();
                $variables = $customerBp->getVariables();
                $form = $event->getForm();
                $form->add('customerVariables', CollectionType::class, [
                    'entry_type' => CustomerVariableType::class,
                    'label' => 'Variables BP à modifier',
                    'entry_options' => ['label' => false, 'variables' => $variables, 'bpModel' => $bpModel],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]);
            })
            /*->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $customerBp = $event->getData();
                $variables = $customerBp->getVariables();
                $form = $event->getForm();
                $form->add('variables', CollectionType::class, [
                    'entry_type' => CustomerVariableType::class,
                    'label' => 'Variables BP à modifier',
                    'entry_options' => ['label' => false, 'variables' => $variables],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]);
            })*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerBP::class,
            'bpModel' => null
        ]);
    }
}
