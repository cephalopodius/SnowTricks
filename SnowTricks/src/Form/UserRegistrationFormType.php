<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('uploadPictureProfile', FileType::class, ([
                'label' => 'Uploads (JPG file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the  file
                // everytime you edit the Product details
                'required' => false,

            ]))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
