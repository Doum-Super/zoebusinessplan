<?php

namespace App\Form;

use App\Entity\CustomerVariable;
use App\Entity\Variable;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerVariableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $variables = $options['variables'];
        $bpModel = $options['bpModel'];
        $propertyPath = isset($options['property_path']) ? $options['property_path'] : null;
        $index = 0;
        if ($propertyPath !== null) {
            preg_match_all("/\\[(.*?)\\]/", $propertyPath, $matches); 
            $index = (int)$matches[1][0];
        }
        $builder
            //->add('value')
            //->add('customerBp')
            ->add('variable', EntityType::class, [
                'class' => Variable::class,
                'choice_label' => 'name',
                'label' => 'Variable',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Variable'],
                'query_builder' => function(EntityRepository $er) use ($bpModel) {
                    return $er->createQueryBuilder('v')
                              ->leftJoin('v.bPModel', 'bpModel')
                              ->leftJoin('bpModel.bPModelRoles', 'bPModelRole')
                              ->leftJoin('bPModelRole.role', 'role')
                              ->where('bpModel.id = :id')
                              ->andWhere('role.code = :role')
                              ->setParameter('id', $bpModel->getId())
                              ->setParameter('role', 'ROLE_CUSTOMER')
                            ;
                }
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($variables, $index) {
                $form = $event->getForm();

                //dump($variables); die;

                $params = [
                    'label' => 'Valeur de la variable',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'Valeur de la variable'],
                    'required' => false
                ];
        
                if (isset($variables[$index]) && null !== $variables[$index]->getVariable() && $variables[$index]->getVariable()->getType() === 'number') {
                    $params['html5'] = true;
                    $form
                        ->add('value', NumberType::class, $params);
                } else $form->add('value', TextType::class, $params);
            })
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerVariable::class,
            'variables' => [],
            'bpModel' => null
        ]);
    }
}
