<?php

namespace App\Form;

use App\Entity\Registration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true
            ])
            ->add('name', TextType::class, [
                'required' => true
            ])
            ->add('plus_one', CheckboxType::class, [
                'required' => true
            ])
            ->add('number_kids', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new Range([
                        'min' => 0,
                        'max' => 99,
                    ])
                ],
                'attr' => [
                    'min' => 0,
                    'max' => 99,
                ]
            ])
            ->add('number_vegetarians', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new Range([
                        'min' => 0,
                        'max' => 99,
                    ])
                ],
                'attr' => [
                    'min' => 0,
                    'max' => 99,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registration::class,
        ]);
    }
}
