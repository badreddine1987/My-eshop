<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProduitFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('color', TextType::class, [
                'label' => 'Couleur',
            ])
            ->add('size', ChoiceType::class, [
                'label' => 'Taille',
                'choices' => [
                    'S' => 's',
                    'M' => 'm',
                    'L' => 'l',
                    'XL' => 'xl',
                    'XXL' => 'xxl',
                ]
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme'
                ]
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo du produit',
                'data_class' => null,
                'constraints' => [
                    new Image([
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Les formats autorisés sont : .jpg .png',
                        'maxSize' => '3M',
                        'maxSizeMessage' => 'Le poids maximal du fichier est : {{ limit }} {{ suffix}} => {{ name }}: {{ size }} {{ suffix}}'
                    ]),
                ],
                'help' => 'Formats autorisés sont : .jpg .png'

            ])
            ->add('price', TextType::class, [
                'label' => 'Prix',
            ])
            ->add('stock', TextType::class, [
                'label' => 'Quantité',
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['photo'] ? 'modifier produit' : 'Ajouter produit',
                'validate' => false,
                'attr' => [
                    'class' => 'd-block mx-auto btn btn-warning col-4'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            'allow_file_upload' => true,
            'photo' => null,
        ]);
    }
}
