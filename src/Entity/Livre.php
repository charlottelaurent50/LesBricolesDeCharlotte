<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'livre', targetEntity: Patron::class)]
    private Collection $patrons;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function __construct()
    {
        $this->patrons = new ArrayCollection();
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
     * @return Collection<int, Patron>
     */
    public function getPatrons(): Collection
    {
        return $this->patrons;
    }

    public function addPatron(Patron $patron): self
    {
        if (!$this->patrons->contains($patron)) {
            $this->patrons->add($patron);
            $patron->setLivre($this);
        }

        return $this;
    }

    public function removePatron(Patron $patron): self
    {
        if ($this->patrons->removeElement($patron)) {
            // set the owning side to null (unless already changed)
            if ($patron->getLivre() === $this) {
                $patron->setLivre(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
