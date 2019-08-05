<?php


namespace App\Form;


use App\Entity\Groupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFormType extends AbstractType
{
    public function  buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title')
                ->add('content')
                ->add('picture')
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