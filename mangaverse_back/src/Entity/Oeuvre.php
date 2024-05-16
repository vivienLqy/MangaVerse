<?php

namespace App\Entity;


use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
// #[ApiResource()]
#[Groups(['getOeuvre'])]

class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("getProduct")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getProduct", "getCategorie"])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups("getProduct")]
    private ?string $text = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["getProduct"])]
    private ?float $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $pegi = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'oeuvres')]
    #[Groups("getProduct")]
    private Collection $genres;

    #[ORM\Column(type: "datetime_immutable")]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: "datetime_immutable")]
    private ?\DateTimeImmutable $update_at = null;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    #[MaxDepth(1)]
    #[Groups(["getProduct"])]
    private ?Auteur $auteur = null;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    #[MaxDepth(1)]
    private ?Categorie $categorie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    private ?Type $type = null;



    public function __construct()
    {
        $this->genres = new ArrayCollection();
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getPegi(): ?string
    {
        return $this->pegi;
    }

    public function setPegi(?string $pegi): static
    {
        $this->pegi = $pegi;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeImmutable $update_at): static
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addOeuvre($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeOeuvre($this);
        }

        return $this;
    }
}
