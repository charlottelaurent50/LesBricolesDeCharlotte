<?php

namespace App\Form;

use App\Entity\Patron;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PatronType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, array('label'=>'  '))
            ->add('maTaille', TextType::class, array('label'=>'  '))
            ->add('metrage', TextType::class, array('label'=>'  '))
            ->add('tissu', TextType::class, array('label'=>'  '))
            ->add('remarque', TextAreaType::class, array('label'=>'  '))
            ->add('decalque', TextType::class, array('label'=>'  '))
            ->add('taille_decalque', TextType::class, array('label'=>'  '))
            ->add('image', TextAreaType::class, array(
                'label'=>'  ',
                'empty_data'=>'img/'))
            ->add('accessoireProv', TextAreaType::class, array('label'=>'  '))
            ->add('livre', EntityType::class, array('class'=>'App\Entity\Livre', 'choice_label'=>'nom','label'=>'  '))
            ->add('categorie', EntityType::class, array('class'=>'App\Entity\Categorie', 'choice_label'=>'nom','label'=>'  '))
            ->add('genre', EntityType::class, array('class'=>'App\Entity\Genre', 'choice_label'=>'nom','label'=>'  '))
            #->add('creations')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patron::class,
        ]);
    }
}
