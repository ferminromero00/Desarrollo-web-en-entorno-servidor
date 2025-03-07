<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
class Proveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notas = null;

    /**
     * @var Collection<int, Gasto>
     */
    #[ORM\OneToMany(targetEntity: Gasto::class, mappedBy: 'proveedor')]
    private Collection $gastos;

    public function __construct()
    {
        $this->gastos = new ArrayCollection();
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

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(?string $notas): static
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * @return Collection<int, Gasto>
     */
    public function getGastos(): Collection
    {
        return $this->gastos;
    }

    public function addGasto(Gasto $gasto): static
    {
        if (!$this->gastos->contains($gasto)) {
            $this->gastos->add($gasto);
            $gasto->setProveedor($this);
        }

        return $this;
    }

    public function removeGasto(Gasto $gasto): static
    {
        if ($this->gastos->removeElement($gasto)) {
            // set the owning side to null (unless already changed)
            if ($gasto->getProveedor() === $this) {
                $gasto->setProveedor(null);
            }
        }

        return $this;
    }
}
