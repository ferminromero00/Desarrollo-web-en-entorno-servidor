<?php

namespace App\Entity;

use App\Repository\InstrumentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstrumentoRepository::class)]
class Instrumento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'instrumentos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $profesor = null;

    /**
     * @var Collection<int, Matricula>
     */
    #[ORM\OneToMany(targetEntity: Matricula::class, mappedBy: 'instrumento')]
    private Collection $matriculas;

    public function __construct()
    {
        $this->matriculas = new ArrayCollection();
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

    public function getProfesor(): ?Usuario
    {
        return $this->profesor;
    }

    public function setProfesor(?Usuario $profesor): static
    {
        $this->profesor = $profesor;

        return $this;
    }

    /**
     * @return Collection<int, Matricula>
     */
    public function getMatriculas(): Collection
    {
        return $this->matriculas;
    }

    public function addMatricula(Matricula $matricula): static
    {
        if (!$this->matriculas->contains($matricula)) {
            $this->matriculas->add($matricula);
            $matricula->setInstrumento($this);
        }

        return $this;
    }

    public function removeMatricula(Matricula $matricula): static
    {
        if ($this->matriculas->removeElement($matricula)) {
            // set the owning side to null (unless already changed)
            if ($matricula->getInstrumento() === $this) {
                $matricula->setInstrumento(null);
            }
        }

        return $this;
    }
}
