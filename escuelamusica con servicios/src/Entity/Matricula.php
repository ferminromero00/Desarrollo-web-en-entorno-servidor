<?php

namespace App\Entity;

use App\Repository\MatriculaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatriculaRepository::class)]
class Matricula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'instrumentos_que_cursa')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $alumno = null;

    #[ORM\ManyToOne(inversedBy: 'matriculas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Instrumento $instrumento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlumno(): ?Usuario
    {
        return $this->alumno;
    }

    public function setAlumno(?Usuario $alumno): static
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getInstrumento(): ?Instrumento
    {
        return $this->instrumento;
    }

    public function setInstrumento(?Instrumento $instrumento): static
    {
        $this->instrumento = $instrumento;

        return $this;
    }
}
