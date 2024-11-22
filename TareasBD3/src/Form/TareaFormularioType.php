<?php

namespace App\Form;

use App\Entity\Tarea;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TareaFormularioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('FechaInicio', null, [
                'widget' => 'single_text',
            ])
            ->add('FechaFin', null, [
                'widget' => 'single_text',
            ])
            ->add('Usuario', EntityType::class, [
                'class' => Usuario::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tarea::class,
        ]);
    }
}
