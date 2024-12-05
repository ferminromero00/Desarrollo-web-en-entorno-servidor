<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre_apellidos = null;

    #[ORM\Column]
    private ?bool $profesor = null;

    /**
     * @var Collection<int, Instrumento>
     */
    #[ORM\OneToMany(targetEntity: Instrumento::class, mappedBy: 'profesor')]
    private Collection $instrumentos;

    /**
     * @var Collection<int, Matricula>
     */
    #[ORM\OneToMany(targetEntity: Matricula::class, mappedBy: 'alumno')]
    private Collection $matricula;

    public function __construct()
    {
        $this->instrumentos = new ArrayCollection();
        $this->matricula = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNombreApellidos(): ?string
    {
        return $this->nombre_apellidos;
    }

    public function setNombreApellidos(string $nombre_apellidos): static
    {
        $this->nombre_apellidos = $nombre_apellidos;

        return $this;
    }

    public function isProfesor(): ?bool
    {
        return $this->profesor;
    }

    public function setProfesor(bool $profesor): static
    {
        $this->profesor = $profesor;

        return $this;
    }

    /**
     * @return Collection<int, Instrumento>
     */
    public function getInstrumentos(): Collection
    {
        return $this->instrumentos;
    }

    public function addInstrumento(Instrumento $instrumento): static
    {
        if (!$this->instrumentos->contains($instrumento)) {
            $this->instrumentos->add($instrumento);
            $instrumento->setProfesor($this);
        }

        return $this;
    }

    public function removeInstrumento(Instrumento $instrumento): static
    {
        if ($this->instrumentos->removeElement($instrumento)) {
            // set the owning side to null (unless already changed)
            if ($instrumento->getProfesor() === $this) {
                $instrumento->setProfesor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matricula>
     */
    public function getMatricula(): Collection
    {
        return $this->matricula;
    }

    public function addInstrumentosQueCursa(Matricula $matricula): static
    {
        if (!$this->matricula->contains($matricula)) {
            $this->matricula->add($matricula);
            $matricula->setAlumno($this);
        }

        return $this;
    }

    public function removeInstrumentosQueCursa(Matricula $matricula): static
    {
        if ($this->matricula->removeElement($matricula)) {
            // set the owning side to null (unless already changed)
            if ($matricula->getAlumno() === $this) {
                $matricula->setAlumno(null);
            }
        }

        return $this;
    }
}
