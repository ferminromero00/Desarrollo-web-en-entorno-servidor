<?php

namespace App\Form;

use App\Entity\Instrumento;
use App\Entity\Matricula;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FerminAnadirInstrumentoMatriculaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('alumno', EntityType::class, [
            //     'class' => Usuario::class,
            //     'choice_label' => 'id',
            // ])
            ->add('instrumento', EntityType::class, [
                'class' => Instrumento::class,
                'choice_label' => 'nombre',
            ])
            ->add('Subir', SubmitType::class, [
                'label' => 'Nueva Matricula'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matricula::class,
        ]);
    }
}
