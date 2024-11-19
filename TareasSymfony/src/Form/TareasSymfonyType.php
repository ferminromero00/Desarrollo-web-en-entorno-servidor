<?php

namespace App\Form;

use App\Entity\TareasSymfony;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TareasSymfonyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titulo', TextType::class)
            ->add('Guardar', SubmitType::class, ["label" => "Guardar tareas"])
            ->add('Limpiar', SubmitType::class, ["label" => "Eliminar tareas"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TareasSymfony::class,
        ]);
    }
}
