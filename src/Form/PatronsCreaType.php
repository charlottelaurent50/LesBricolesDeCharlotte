<?php

namespace App\Form;

use App\Entity\Patron;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatronsCreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('creation', EntityType::class, array('class'=>'App\Entity\Creation', 'choice_label'=>'id',
        'query_builder' => function(CreationRepository $er)
        {
            return $er->findAllByIdDesc();
        }, 'label'=>'  '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patron::class,
        ]);
    }
}
