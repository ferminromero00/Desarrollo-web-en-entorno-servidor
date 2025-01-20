<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoRepository::class)]
class Pedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    /*#[ORM\ManyToOne(inversedBy: 'pedidos',  cascade:['detach'])]
    #[ORM\JoinColumn(nullable:false)]*/

    #[ORM\Column]
    // Creamos una propiedad asociada con el campo cliente_id de la base de datos
    private ?int $clienteId;

    // Desvinculamos la entidad cliente de Doctrine
    private ?Cliente $cliente = null;

    /**
     * @var Collection<int, LineaPedido>
     */
    // , cascade:['persist']
    #[ORM\OneToMany(targetEntity: LineaPedido::class, mappedBy: 'pedido')]
    private Collection $lineaPedidos;

   
    public function __construct()
    {
        $this->lineaPedidos = new ArrayCollection();
    }

    public function getClienteId(): ?int
    {
        return $this->clienteId;
    }

    public function setClienteId(int $id): static
    {
        $this->clienteId = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection<int, LineaPedido>
     */
    public function getLineaPedidos(): Collection
    {
        return $this->lineaPedidos;
    }

    public function addLineaPedido(LineaPedido $lineaPedido): static
    {
        if (!$this->lineaPedidos->contains($lineaPedido)) {
            $this->lineaPedidos->add($lineaPedido);
            $lineaPedido->setPedido($this);
        }

        return $this;
    }

    public function removeLineaPedido(LineaPedido $lineaPedido): static
    {
        if ($this->lineaPedidos->removeElement($lineaPedido)) {
            // set the owning side to null (unless already changed)
            if ($lineaPedido->getPedido() === $this) {
                $lineaPedido->setPedido(null);
            }
        }

        return $this;
    }

    public function getTotalPedido() {

        $total = 0;
        $lineas = $this->getLineaPedidos();

        foreach ($lineas as $linea) {
            $total = $total + $linea->getArticulo()->getPrecio()*$linea->getCantidad();
        }
        return $total;
    }

  
}
