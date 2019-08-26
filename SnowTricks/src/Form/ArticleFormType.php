<?php


namespace App\Form;


use App\Entity\Gallery;
use App\Entity\Groupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticleFormType extends AbstractType
{
    public function  buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title')
                ->add('content')
                ->add('picture')


                 ->add('uploads', FileType::class, ([
                    'label' => 'Uploads (JPG file)',




                    // unmapped means that this field is not associated to any entity property
                    'mapped' => false,

                    // make it optional so you don't have to re-upload the  file
                    // everytime you edit the Product details
                    'required' => false,

                    // unmapped fields can't define their validation using annotations
                    // in the associated entity, so you can use the PHP constraint classes
                     'multiple' => true
                 ]))

                 ->add('groupe',EntityType::class, [
                     'class'=> Groupe::class,
                        'choice_label' =>'Groupname',],
                  ChoiceType::class, [
                     'choices' => [
                        'Les Grabs'=> '9',
                        'Les Rotations'=> '10',
                        'Les Flips'=> '11',
                        'Les Rotations désaxées'=> '12',
                        'Les Slides'=> '13',
                        'Les OneFoot Tricks'=> '14',
                ],
            ]);



    }
}