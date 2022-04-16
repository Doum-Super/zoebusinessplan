<?php

namespace App\Form;

use App\Entity\Variable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la variable',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom de la variable']
            ])
            ->add('definition', TextType::class, [
                'label' => 'Definition de la variable',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Definition de la variable'],
                'required' => false
            ])
            ->add('value', TextType::class, [
                'label' => 'Valeur de la variable',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Valeur de la variable'],
                'required' => false
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type de la variable',
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    'Texte' => 'text',
                    'Nombre' => 'number'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Variable::class,
        ]);
    }
}
