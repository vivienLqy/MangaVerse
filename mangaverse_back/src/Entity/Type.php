<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
#[Groups(['getType'])]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["getProduct", "getOeuvre"])]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Oeuvre::class, mappedBy: 'type')]
    private Collection $oeuvres;

    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'type')]
    private Collection $Types;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Oeuvre>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvre $oeuvre): static
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->add($oeuvre);
            $oeuvre->setType($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getType() === $this) {
                $oeuvre->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getTypes(): Collection
    {
        return $this->Types;
    }

    public function addType(Product $type): static
    {
        if (!$this->Types->contains($type)) {
            $this->Types->add($type);
            $type->setType($this);
        }

        return $this;
    }

    public function removeType(Product $type): static
    {
        if ($this->Types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getType() === $this) {
                $type->setType(null);
            }
        }

        return $this;
    }
}
