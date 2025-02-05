<?php

namespace App\Entity;

use App\Repository\LineaPedidoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineaPedidoRepository::class)]
class LineaPedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\ManyToOne(inversedBy: 'lineaPedidos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pedido $pedido = null;

    /*#[ORM\OneToOne]
     #[ORM\JoinColumn(nullable: false)]*/
    // Desvinculo el objeto de la entidad
    private ?Articulo $articulo = null;

    #[ORM\Column]
    private ?int $articuloId; // Hacer referencia al campo atriculo_id de la tabla LineaPedido

    public function getId (): ?int
    { 
        return $this->id;
    }

    public function getArticuloId (): ?int
    { 
        return $this->articuloId;
    }

    public function setArticuloId ($id): static
    { 
        $this->articuloId = $id;
        return $this;
    }



    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPedido(): ?Pedido
    {
        return $this->pedido;
    }

    public function setPedido(?Pedido $pedido): static
    {
        $this->pedido = $pedido;

        return $this;
    }

    public function getArticulo(): ?Articulo
    {
        return $this->articulo;
    }

    public function setArticulo(?Articulo $articulo): static
    {
        $this->articulo = $articulo;

        return $this;
    }
}
