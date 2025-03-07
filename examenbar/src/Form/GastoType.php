<?php

namespace App\Form;

use App\Entity\Gasto;
use App\Entity\Proveedor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use App\Repository\ProveedorRepository;

class GastoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateType::class,                 
                ['required' => true,'widget' => 'single_text', 
                #'data' => new \DateTime(),
                'label' => 'Fecha', 'attr' => ['class' => 'form-control']
            ])
            ->add('cantidad', NumberType::class, 
                ['required' => true,'label' => 'Cantidad', 'attr' => ['class' => 'form-control']])            
            ->add('proveedor', EntityType::class, [
                'class' => Proveedor::class,
                'choice_label' => 'nombre',              
                'query_builder' => function (ProveedorRepository $er) {
                    return $er->createQueryBuilder('p')
                          ->orderBy('p.nombre', 'ASC'); // Ordenar alfabéticamente por 'nombre'
            },
            ])
            ->add('factura', CheckboxType::class, 
                ['required' => false, 'label' => 'Con factura'])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gasto::class,
        ]);
    }
}
