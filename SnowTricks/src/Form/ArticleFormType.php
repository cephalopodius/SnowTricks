<?php


namespace App\Form;

use App\Entity\Article;
use App\Entity\Gallery;
use App\Entity\Groupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function  buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title')
                ->add('content')
                ->add('uploadMainPicture', FileType::class, ([
                   'label' => "Uploads de l'image principale (fichier JPG)",

                   // unmapped means that this field is not associated to any entity property
                   'mapped' => false,

                   // make it optional so you don't have to re-upload the  file
                   // everytime you edit the Product details
                   'required' => false,

                   // unmapped fields can't define their validation using annotations
                   // in the associated entity, so you can use the PHP constraint classes
                    'multiple' => false
                ]))
                 ->add('uploads', FileType::class, ([
                    'label' => 'Uploads des images de galleries(fichier JPG)',
                    'mapped' => false,
                    'required' => false,
                     'multiple' => true
                 ]))

                 ->add('groupe', EntityType::class, [
                     'class'=> Groupe::class,
                     'choice_label' =>'Groupname',
                    ],
                     ChoiceType::class
                   );
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
