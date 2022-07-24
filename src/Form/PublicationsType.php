<?php

namespace App\Form;

use App\Entity\Publications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('slug')
            ->add('contenu')
            ->add('featuredText')
            ->add('isActive')
            ->add('isPublished')
            ->add('publishedAt')
            ->add('favoris')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('author')
            ->add('categorie')
            ->add('featuredImage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Publications::class,
        ]);
    }
}
