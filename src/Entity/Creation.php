<?php

namespace App\Entity;

use App\Repository\CreationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreationRepository::class)]
class Creation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $tissu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarque = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lien_insta = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Patron::class, mappedBy: 'creations')]
    private Collection $patrons;

    public function __construct()
    {
        $this->patrons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTissu(): ?string
    {
        return $this->tissu;
    }

    public function setTissu(?string $tissu): self
    {
        $this->tissu = $tissu;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getLienInsta(): ?string
    {
        return $this->lien_insta;
    }

    public function setLienInsta(?string $lien_insta): self
    {
        $this->lien_insta = $lien_insta;

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
            $patron->addCreation($this);
        }

        return $this;
    }

    public function removePatron(Patron $patron): self
    {
        if ($this->patrons->removeElement($patron)) {
            $patron->removeCreation($this);
        }

        return $this;
    }


}
