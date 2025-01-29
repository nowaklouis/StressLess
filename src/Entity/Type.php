<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Contenu>
     */
    #[ORM\OneToMany(targetEntity: Contenu::class, mappedBy: 'type')]
    private Collection $contenus;

    public function __construct()
    {
        $this->contenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Contenu>
     */
    public function getContenus(): Collection
    {
        return $this->contenus;
    }

    public function addContenu(Contenu $contenu): static
    {
        if (!$this->contenus->contains($contenu)) {
            $this->contenus->add($contenu);
            $contenu->setType($this);
        }

        return $this;
    }

    public function removeContenu(Contenu $contenu): static
    {
        if ($this->contenus->removeElement($contenu)) {
            // set the owning side to null (unless already changed)
            if ($contenu->getType() === $this) {
                $contenu->setType(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }
}
