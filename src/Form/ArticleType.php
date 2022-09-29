<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // l'objet $builder permet de créer un formulaire
        // la méthode add() permet d'ajouter un champ au formulaire
        $builder
            ->add('title')
            ->add('content'
            // , TextType::class,[
            //     'attr' =>[
            //         'placeholder' => "Contenu de l'article",
            //         'style' => "border-radius: 5px",
            //         'class' => "form-control"
            //     ]
            // ]
            ) //je modifie le champs content en tant qu'input text
            ->add('image')
            // ->add('createdAt')
            // nous commentons ce champ car la date d'ajout sera ajoutée automatiquement lors de l'insertion de l'article
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
