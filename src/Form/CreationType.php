<?php

namespace App\Form;

use App\Entity\Creation;
use App\Entity\Patron;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'label'=>'  ',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                 ])
            ->add('tissu', TextType::class, array('label'=>'  '))
            ->add('remarque', TextType::class, array('label'=>'  '))
            ->add('lien_insta', TextType::class, array('label'=>'  '))
            ->add('image', TextType::class, array('label'=>'  '))
            ->add('patrons', EntityType::class, array(
                'class'=>'App\Entity\Patron', 
                'choice_label'=>'nom', 
                'label'=>'  ',
                'multiple' => true,
                'expanded' => true,))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Creation::class,
        ]);
    }
}
