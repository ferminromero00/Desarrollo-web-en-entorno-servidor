<?php

namespace App\Form;

use App\Entity\Caja;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CajaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateType::class, 
                ['required' => true,'widget' => 'single_text', 
                # 'data' => new \DateTime(),'label' => 'Fecha',
                 'attr' => ['class' => 'form-control']])            
            ->add('cantidad', NumberType::class, 
                ['required' => true,'label' => 'Cantidad', 'attr' => ['class' => 'form-control']])            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Caja::class,
        ]);
    }
}
