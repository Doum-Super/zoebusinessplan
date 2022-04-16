<?php

namespace App\Form;

use App\Entity\BPModel;
use App\Entity\BPModelRole;
use App\Entity\Role;
use App\Entity\Variable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BPModelRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bpModel', EntityType::class, [
                'class' => BPModel::class,
                'choice_label' => 'name',
                'label' => 'Modèle Business Plan',
                'attr' => ['class' => 'form-control'],
                'placeholder' => 'Choisir un Business Plan'
            ])
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'name',
                'label' => 'Role',
                'attr' => ['class' => 'form-control']
            ])
            ->add('variables', EntityType::class, [
                'class' => Variable::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'select2 form-control', 'multiple' => 'multiple'],
                'expanded' => false,
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BPModelRole::class,
        ]);
    }
}
