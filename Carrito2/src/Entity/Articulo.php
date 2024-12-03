<?php

namespace App\Entity;

use App\Repository\ArticuloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticuloRepository::class)]
class Articulo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?float $precio = null;

    /**
     * @var Collection<int, LineaPedido>
     */
    #[ORM\OneToMany(targetEntity: LineaPedido::class, mappedBy: 'articulo')]
    private Collection $lineaPedidos;

    public function __construct()
    {
        $this->lineaPedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): static
    {
        $this->precio = $precio;

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
            $lineaPedido->setArticulo($this);
        }

        return $this;
    }

    public function removeLineaPedido(LineaPedido $lineaPedido): static
    {
        if ($this->lineaPedidos->removeElement($lineaPedido)) {
            // set the owning side to null (unless already changed)
            if ($lineaPedido->getArticulo() === $this) {
                $lineaPedido->setArticulo(null);
            }
        }

        return $this;
    }
}
