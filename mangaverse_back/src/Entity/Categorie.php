<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
// #[ApiResource()]
#[Groups(['getCategorie'])]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getProduct", "getOeuvre"])]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Oeuvre::class, mappedBy: 'categorie')]
    private Collection $oeuvres;

    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'categorie')]
    private Collection $categories;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
        $this->categories = new ArrayCollection();
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
     * @return Collection<int, oeuvre>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(oeuvre $oeuvre): static
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->add($oeuvre);
            $oeuvre->setCategorie($this);
        }

        return $this;
    }

    public function removeOeuvre(oeuvre $oeuvre): static
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getCategorie() === $this) {
                $oeuvre->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Product $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setCategorie($this);
        }

        return $this;
    }

    public function removeCategory(Product $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategorie() === $this) {
                $category->setCategorie(null);
            }
        }

        return $this;
    }
}
