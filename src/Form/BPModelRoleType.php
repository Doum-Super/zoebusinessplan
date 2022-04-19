<?php

namespace App\Form;

use App\Entity\BPModel;
use App\Entity\BPModelRole;
use App\Entity\Role;
use App\Entity\Variable;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
                $form = $event->getForm();
                $bpModelRole = $event->getData();
                $params = [
                    'class' => Variable::class,
                    'choice_label' => 'name',
                    'attr' => ['class' => 'select2 form-control', 'multiple' => 'multiple'],
                    'expanded' => false,
                    'multiple' => true,
                ];
                if (null !== $bpModelRole->getBpModel()) {
                    $params['query_builder'] = function(EntityRepository $er) use ($bpModelRole) {
                        return $er->createQueryBuilder('v')
                                  ->where('v.bPModel = :bpModel')
                                  ->setParameter('bpModel', $bpModelRole->getBpModel())
                                ;
                    };
                }
                $form
                    ->add('variables', EntityType::class, $params);
            });
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BPModelRole::class,
        ]);
    }
}
