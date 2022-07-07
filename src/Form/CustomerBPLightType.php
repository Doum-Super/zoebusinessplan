<?php

namespace App\Form;

use App\Entity\CustomerBP;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerBPLightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $bpModel = $options['bpModel'];
        $variables = $options['variables'];
        $builder
            ->add('businessName', TextType::class, [
                //'label' => "Raison sociale de l'entreprise",
                'label' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => "Raison sociale de l'entreprise"],
                'required' => false
            ])
            ->add('projectDescription', TextareaType::class, [
                //'label' => 'Description du projet',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Description du projet'],
                'required' => false
            ])
            ->add('beneficiaryFirstName', TextType::class, [
                //'label' => 'Prénom du beneficiaire',
                'label' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom du beneficiaire'],
                'required' => false
            ])
            ->add('beneficiaryLastName', TextType::class, [
                //'label' => 'Nom du beneficiaire',
                'label' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom du beneficiaire'],
                'required' => false
            ])
            ->add('beneficiarySex', ChoiceType::class, [
                //'label' => 'Sexe du beneficiaire',
                'label' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Sexe du beneficiaire'],
                'choices' => [
                    'Homme' => 'male',
                    'Femme' => 'female'
                ],
                //'required' => false
            ])
            ->add('beneficiaryMaritalStatus', ChoiceType::class, [
                //'label' => 'Situation matrimoniale du beneficiaire',
                'label' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Situation matrimoniale'],
                'choices' => [
                    'Célibataire' => 'célibataire',
                    'Marié(e)' => 'marié'
                ],
                //'required' => false
            ])
            ->add('beneficiaryPhoneNumber', TextType::class, [
                //'label' => 'Numéro du beneficiaire',
                'label' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro du beneficiaire'],
                'required' => false
            ])
            ->add('beneficiaryAddress', TextType::class, [
                //'label' => 'Adresse du beneficiaire',
                'label' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse du beneficiaire'],
                'required' => false
            ])
            ->add('beneficiaryStudyLevel',  ChoiceType::class, [
                //'label' => "Niveau d'étude du beneficiaire",
                'label' => false,
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    'BAC' => 'BAC',
                    'BAC+2' => 'BAC+2',
                    'BAC+3' => 'BAC+3',
                    'BAC+4' => 'BAC+4',
                    'BAC+5 et plus' => 'BAC+5 et plus',
                ],
                'placeholder' => "Niveau d'étude du beneficiaire",
                'required' => false
            ])
            ->add('marketDescription', TextareaType::class, [
                //'label' => 'Description du marchet',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Description du marchet'],
                'required' => false
            ])
            ->add('projectSummary', TextareaType::class, [
                //'label' => 'Resumé du projet',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Resumé du projet'],
                'required' => false
            ])
            ->add('customerDateOfBirth', DateType::class, [
                //'label' => 'Date de naissance',
                'label' => false,
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'attr' => ['class' => 'form-control js-datepicker', 'placeholder' => 'Date de naissance'],
                'required' => false
            ])
            ->add('customerPlaceOfBirth', TextType::class, [
                //'label' => 'Lieu de naissance',
                'label' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Lieu de naissance'],
                'required' => false
            ])
            ->add('humanResource', TextareaType::class, [
                //'label' => 'Moyens humains',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Moyens humains'],
                'required' => false
            ])
            ->add('realizationProgram', TextareaType::class, [
                //'label' => 'Programme de réalisation',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Programme de réalisation'],
                'required' => false
            ])
            ->add('materialResource', TextareaType::class, [
                //'label' => 'Moyens matériels',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Moyens matériels'],
                'required' => false
            ])
            ->add('workingCapitalComment', TextareaType::class, [
                //'label' => 'Commentaire du tableau de fond de roulement',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Commentaire du tableau de fond de roulement'],
                'required' => false
            ])
            ->add('financingNeedsComment', TextareaType::class, [
                //'label' => 'Commentaire du tableau de besoins de financement',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Commentaire du tableau de besoins de financement'],
                'required' => false
            ])
            ->add('revenueForecastComment', TextareaType::class, [
                //'label' => 'Commentaire du tableau de prévision des recettes',
                'label' => false,
                'attr' => ['class' => 'form-control summernote', 'placeholder' => 'Commentaire du tableau de prévision des recettes'],
                'required' => false
            ])
            ->add('customerVariables', CollectionType::class, [
                'entry_type' => CustomerVariableType::class,
                'label' => false,
                //'label' => 'Variables BP à modifier',
                'entry_options' => ['label' => false, 'variables' => $variables, 'bpModel' => $bpModel],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerBP::class,
            'bpModel' => null,
            'variables' => [],
        ]);
    }
}
