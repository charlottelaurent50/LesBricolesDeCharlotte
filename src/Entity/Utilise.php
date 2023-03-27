<?php

namespace App\Entity;

use App\Repository\UtiliseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtiliseRepository::class)]
class Utilise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'utilise')]
    private ?Patron $patron = null;

    #[ORM\ManyToOne(inversedBy: 'utilise')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Accessoire $accessoire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPatron(): ?Patron
    {
        return $this->patron;
    }

    public function setPatron(?Patron $patron): self
    {
        $this->patron = $patron;

        return $this;
    }

    public function getAccessoire(): ?Accessoire
    {
        return $this->accessoire;
    }

    public function setAccessoire(?Accessoire $accessoire): self
    {
        $this->accessoire = $accessoire;

        return $this;
    }
}
