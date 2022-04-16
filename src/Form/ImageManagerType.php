<?php

namespace App\Form;

use App\Entity\ImageManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class ImageManagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'Choisir fichier',
                'label_attr' => ['class' => 'custom-file-label'],
                'attr' => ['class' => 'custom-file-input'],
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg'
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier image (png, jpeg ou jpg) valide',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). La taille maximale autorisée est {{ limit }} {{ suffix }}.'
                    ]),
                    new Image([
                        'minWidth' => 1140,
                        'minHeight' => 430,
                        'minWidthMessage' => "La largeur de l'image est trop petite ({{ width }} px). La largeur minimale attendue est de {{ min_width }} px.",
                        'minHeightMessage' => "La hauteur de l'image est trop petite ({{ height }} px). La hauteur minimale attendue est de {{ min_height }} px.",
                        'groups' => ['large_cover']
                    ]),
                    new Image([
                        'minWidth' => 720,
                        'minHeight' => 630,
                        'minWidthMessage' => "La largeur de l'image est trop petite ({{ width }} px). La largeur minimale attendue est de {{ min_width }} px.",
                        'minHeightMessage' => "La hauteur de l'image est trop petite ({{ height }} px). La hauteur minimale attendue est de {{ min_height }} px.",
                        'groups' => ['small_cover']
                    ]),
                    new Image([
                        'minWidth' => 475,
                        'minHeight' => 760,
                        'minWidthMessage' => "La largeur de l'image est trop petite ({{ width }} px). La largeur minimale attendue est de {{ min_width }} px.",
                        'minHeightMessage' => "La hauteur de l'image est trop petite ({{ height }} px). La hauteur minimale attendue est de {{ min_height }} px.",
                        'groups' => ['dg_img', 'cv_photo']
                    ]),
                    new Image([
                        'minWidth' => 185,
                        'minHeight' => 140,
                        'minWidthMessage' => "La largeur de l'image est trop petite ({{ width }} px). La largeur minimale attendue est de {{ min_width }} px.",
                        'minHeightMessage' => "La hauteur de l'image est trop petite ({{ height }} px). La hauteur minimale attendue est de {{ min_height }} px.",
                        'groups' => ['epn_logo']
                    ]),
                    new File([
                        'maxSize' => '2024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg'
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier image (png, jpeg ou jpg) valide',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). La taille maximale autorisée est {{ limit }} {{ suffix }}.',
                        'groups' => ['organization_chart_image']
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImageManager::class,
        ]);
    }
}
