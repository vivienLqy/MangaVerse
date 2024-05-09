<?php

namespace App\Service;

use App\Entity\Categorie;
use App\Entity\Oeuvre;
use App\Entity\Product;
use App\Entity\Type;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Product $product)
    {
        $newProduct = new Product();
        $newProduct->setName($product->getName());
        $newProduct->setPrix($product->getPrix());
        $newProduct->setQuantiter($product->getQuantiter());
        $newProduct->setCreatedAt(new \DateTimeImmutable());

        if ($product->getCategorie()) {
            $categorieName = $product->getCategorie()->getName();

            $categorie = $this->em->getRepository(Categorie::class)->findOneBy(['name' => $categorieName]);

            if ($categorie) {
                $newProduct->setCategorie($this->em->getReference(Categorie::class, $categorie->getId()));
            } else {
                throw new \Exception("La catégorie spécifiée n'existe pas.");
            }
        }
        if ($product->getOeuvres()) {
            $oeuvreName = $product->getOeuvres()->getName();
            $oeuvre = $this->em->getRepository(Oeuvre::class)->findOneBy(['name' => $oeuvreName]);

            if ($oeuvre) {
                $newProduct->setOeuvres($this->em->getReference(Oeuvre::class, $oeuvre->getId()));
            } else {
                throw new \Exception("L'œuvre spécifiée n'existe pas.");
            }
        }
        if ($product->getType()) {
            $typeName = $product->getType()->getName();
            $type = $this->em->getRepository(Type::class)->findOneBy(['name' => $typeName]);

            if ($type) {
                $newProduct->setType($this->em->getReference(Type::class, $type->getId()));
            } else {
                throw new \Exception("Le type spécifiée n'existe pas.");
            }
        }
        $this->em->persist($newProduct);
        $this->em->flush();
        return $newProduct;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Product::class)->findAll();
    }

    public function get(int $id): Product
    {
        return $this->em->getRepository(Product::class)->find($id);
    }

    public function delete(int $id): string
    {
        $products = $this->em->getRepository(Product::class)->find($id);

        if ($products) {
            $this->em->remove($products);
            $this->em->flush();
            return "L'élément avec l'id $id a été supprimé avec succès.";
        } else {
            return "Aucun élément avec l'id $id n'a été trouvé.";
        }
    }

    public function updateAll(int $id, Product $product): string
    {
        $existingProduct = $this->em->getRepository(Product::class)->find($id);
        if ($existingProduct) {
            $existingProduct
                ->setName($product->getName())
                ->setPrix($product->getPrix())
                ->setPicture($product->getPicture())
                ->setQuantiter($product->getQuantiter())
                ->setCreatedAt($product->getCreatedAt());


            $this->em->flush();
            return "Le produit avec l'ID {$id} a été mis a jour avec succès!";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas";
        }
    }
    public function update(int $id, Product $product): string
    {
        $existingProduct = $this->em->getRepository(Product::class)->find($id);

        if ($existingProduct) {
            $existingProduct->setName($product->getName() ?? $existingProduct->getName());
            $existingProduct->setPrix($product->getPrix() ?? $existingProduct->getPrix());
            $existingProduct->setPicture($product->getPicture() ?? $existingProduct->getPicture());
            $existingProduct->setQuantiter($product->getQuantiter() ?? $existingProduct->getQuantiter());
            $existingProduct->setCreatedAt($product->getCreatedAt() ?? $existingProduct->getCreatedAt());


            $this->em->flush();

            return "Le produit avec l'ID {$id} a été mis à jour avec succès !";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas.";
        }
    }
}
