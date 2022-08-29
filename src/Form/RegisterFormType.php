<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('roles') rien n'a faire dans un formulaire
            ->add('password')
            ->add('firstname')
            ->add('lastname')
            ->add('gender')
            ->add('submit', SubmitType::class, [
                'label' => 'valider'
            
            ])
                // ne doivent jamais apparaitre dans le formulaire
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('deletedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
