<?php

namespace App\Form;

use App\Entity\Appointment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Nom & Prenom',
                'attr'=>[
                    'class'=>'form-control'
                 ]
                ])
            ->add('description',TextareaType::class,[
                'label'=>'Message',
                'attr'=>[
                    'class'=>'form-control'
                 ]
                ])
            ->add('status',TextType::class,[
                'label'=>'status',
                'attr'=>[
                    'class'=>'form-control'
                 ]
                ])
            ->add('adress',TextType::class,[
                'label'=>'Adresse',
                'attr'=>[
                    'class'=>'form-control'
                 ]
                ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
