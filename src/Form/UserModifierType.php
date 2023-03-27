<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('enregistrer', SubmitType::class, 
        array('label' => 'Modifier mon profil') , 
        ['attr' =>  ['class' => 'submit']])
        ->add('password', HiddenType::class, array('disabled'=> true)
        )
        ;
    }

    public function getParent(){
        return RegistrationFormType::class;
      }
   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
