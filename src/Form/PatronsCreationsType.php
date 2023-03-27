<?php

namespace App\Form;

use App\Entity\Patron;
use App\Entity\Creation;
use App\Repository\CreationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PatronsCreationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('patron', EntityType::class, array('class'=>'App\Entity\Patron', 'choice_label'=>'nom', 'label'=>'  '))
        ->add('creation', EntityType::class, array('class'=>'App\Entity\Creation', 'choice_label'=>'id',
        'query_builder' => function(CreationRepository $er)
        {
            return $er->findAllByIdDesc();
        }, 'label'=>'  '))
        ->add('relation', EntityType::class, [
            'class' => Creation::class,
            'multiple' => true,
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patron::class,
        ]);
    }
}
