<?php

namespace App\Entity;

use App\Repository\TareaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TareaRepository::class)]
class Tarea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\ManyToOne(inversedBy: 'tareas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $Usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->Usuario;
    }

    public function setUsuario(?Usuario $Usuario): static
    {
        $this->Usuario = $Usuario;

        return $this;
    }
}
