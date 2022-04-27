<?php
/*
|--------------------------------------------------------
| copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------
*/
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder
            ->add('name', TextType::class,[
                    'empty_data'=>''
                ])
            ->add('last_name', TextType::class,[
                'empty_data'=>''
            ])
            ->add('email', EmailType::class,[
                'empty_data'=>''
            ])


            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                // 'first_options'  => array('label' => 'Password'),
                // 'second_options' => array('label' => 'Repeat Password'),
            ))
        ;

        if( $user && in_array('ROLE_ADMIN', $user->getRoles()) )
        {
            $builder->add('vimeo_api_key', TextType::class,[
                'empty_data'=>''
            ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'user' => null
        ]);
    }
}

