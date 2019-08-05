<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'attr' => array('placeholder' => 'Entrez votre adresse mail')
            ))
            ->add('password', PasswordType::class, array(
                'attr' => array('placeholder' => 'Entrez votre mot de passe')
            ))
            ->add('firstName',\Symfony\Component\Form\Extension\Core\Type\TextType::class, array(
                 'attr' => array('placeholder' => 'Entrez votre nom')
            ))
            ->add('nickname',\Symfony\Component\Form\Extension\Core\Type\TextType::class, array(
                'attr' => array('placeholder' => 'Entrez votre Prénom')
            ))
            ->add('picture',\Symfony\Component\Form\Extension\Core\Type\TextType::class, array(
                'attr' => array('placeholder' => 'Entrez votre image')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
