<?php

namespace App\Entity;

use App\Repository\AccessoireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessoireRepository::class)]
class Accessoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'accessoire', targetEntity: Utilise::class)]
    private Collection $utilise;

    public function __construct()
    {
        $this->utilise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Utilise>
     */
    public function getUtilise(): Collection
    {
        return $this->utilise;
    }

    public function addUtilise(Utilise $utilise): self
    {
        if (!$this->utilise->contains($utilise)) {
            $this->utilise->add($utilise);
            $utilise->setAccessoire($this);
        }

        return $this;
    }

    public function removeUtilise(Utilise $utilise): self
    {
        if ($this->utilise->removeElement($utilise)) {
            // set the owning side to null (unless already changed)
            if ($utilise->getAccessoire() === $this) {
                $utilise->setAccessoire(null);
            }
        }

        return $this;
    }
}
