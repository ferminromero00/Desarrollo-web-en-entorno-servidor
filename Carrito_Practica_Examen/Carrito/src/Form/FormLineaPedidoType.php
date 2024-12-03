<?php

namespace App\Form;

use App\Entity\Articulo;
use App\Entity\LineaPedido;
use App\Entity\Pedido;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormLineaPedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Campo para la cantidad
            ->add('cantidad')
            // Campo para seleccionar un artículo
            ->add('articulo', EntityType::class, [
                'class' => Articulo::class, // Clase de la entidad Articulo
                'choice_label' => 'nombre', // Propiedad de la entidad que se mostrará en las opciones
            ])
            // Botón de envío del formulario
            ->add('agregar', SubmitType::class, ['label' => 'Añadir linea de articulos']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LineaPedido::class,
        ]);
    }
}
