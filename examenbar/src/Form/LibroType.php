<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('fecha', DateType::class, 
            ['widget' => 'single_text', 'data' => new \DateTime(),'label' => 'Fecha', 'attr' => ['class' => 'form-control']])
        /*->add('hasta', DateType::class, 
            ['widget' => 'single_text', 'data' => new \DateTime(),'label' => 'Hasta', 'attr' => ['class' => 'form-control']])*/
        ->add('buscar', SubmitType::class, 
            ['label' => 'Buscar', 'attr' => ['class' => 'btn btn-primary mt-3']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
