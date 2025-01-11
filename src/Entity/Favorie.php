<?php

namespace App\Entity;

use App\Repository\FavorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavorieRepository::class)]
class Favorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'favories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contenu $Contenu = null;

    #[ORM\ManyToOne(inversedBy: 'favories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?Contenu
    {
        return $this->Contenu;
    }

    public function setContenu(?Contenu $Contenu): static
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
