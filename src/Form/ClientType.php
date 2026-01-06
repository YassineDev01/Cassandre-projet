<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       /* $builder
            ->add('nom')
            ->add('email')
        ;*/
        $builder
    ->add('nom', TextType::class, [
        'label' => 'Nom',
        'attr' => [
            'maxlength' => 100,
            'placeholder' => 'Ex: Marie Dupont',
        ],
    ])
    ->add('email', EmailType::class, [
        'label' => 'Email',
        'attr' => [
            'maxlength' => 100,
            'placeholder' => 'ex: marie@domaine.fr',
        ],
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
