<?php

namespace App\Entity;

use App\Repository\PatronRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatronRepository::class)]
class Patron
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?string $maTaille = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $metrage = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $tissu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarque = null;

    #[ORM\Column(nullable: true)]
    private ?bool $decalque = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $taille_decalque = null;

    #[ORM\ManyToOne(inversedBy: 'patrons')]
    private ?Livre $livre = null;

    #[ORM\ManyToOne(inversedBy: 'patrons')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'patrons')]
    private ?Genre $genre = null;

    #[ORM\OneToMany(mappedBy: 'patron', targetEntity: Utilise::class)]
    private Collection $utilise;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'patrons', targetEntity: Like::class)]
    private Collection $likes;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $accessoireProv = null;

    #[ORM\ManyToMany(targetEntity: Creation::class, inversedBy: 'patrons')]
    private Collection $creations;

    public function __construct()
    {
        $this->utilise = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->creations = new ArrayCollection();
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

    public function getMaTaille(): ?string
    {
        return $this->maTaille;
    }

    public function setMaTaille(?string $maTaille): self
    {
        $this->maTaille = $maTaille;

        return $this;
    }

    public function getMetrage(): ?string
    {
        return $this->metrage;
    }

    public function setMetrage(string $metrage): self
    {
        $this->metrage = $metrage;

        return $this;
    }

    public function getTissu(): ?string
    {
        return $this->tissu;
    }

    public function setTissu(string $tissu): self
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

    public function isDecalque(): ?bool
    {
        return $this->decalque;
    }

    public function setDecalque(?bool $decalque): self
    {
        $this->decalque = $decalque;

        return $this;
    }

    public function getTailleDecalque(): ?string
    {
        return $this->taille_decalque;
    }

    public function setTailleDecalque(?string $taille_decalque): self
    {
        $this->taille_decalque = $taille_decalque;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): self
    {
        $this->livre = $livre;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

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
            $utilise->setPatron($this);
        }

        return $this;
    }

    public function removeUtilise(Utilise $utilise): self
    {
        if ($this->utilise->removeElement($utilise)) {
            // set the owning side to null (unless already changed)
            if ($utilise->getPatron() === $this) {
                $utilise->setPatron(null);
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

    /**
     * Permet de savoir si l'utilisateur connecte a aimé le patron
     * 
     * @param /App/Entity/User $user
     * @return boolean
     * 
     */

     public function isLikedByUser(User $user) : bool
     {
        foreach($this->likes as $like){
            if ($like->getUser() === $user) return true;
        }

        return false;

     }

     /**
      * @return Collection<int, Like>
      */
     public function getLikes(): Collection
     {
         return $this->likes;
     }

     public function addLike(Like $like): self
     {
         if (!$this->likes->contains($like)) {
             $this->likes->add($like);
             $like->setPatrons($this);
         }

         return $this;
     }

     public function removeLike(Like $like): self
     {
         if ($this->likes->removeElement($like)) {
             // set the owning side to null (unless already changed)
             if ($like->getPatrons() === $this) {
                 $like->setPatrons(null);
             }
         }

         return $this;
     }

     public function getAccessoireProv(): ?string
     {
         return $this->accessoireProv;
     }

     public function setAccessoireProv(?string $accessoireProv): self
     {
         $this->accessoireProv = $accessoireProv;

         return $this;
     }

     /**
      * @return Collection<int, Creation>
      */
     public function getCreations(): Collection
     {
         return $this->creations;
     }

     public function addCreation(Creation $creation): self
     {
         if (!$this->creations->contains($creation)) {
             $this->creations->add($creation);
         }

         return $this;
     }

     public function removeCreation(Creation $creation): self
     {
         $this->creations->removeElement($creation);

         return $this;
     }
}
