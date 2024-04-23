<?php

namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Product $products)
    {
        $product = new Product();
        $product->setName($products->getName());
        $product->setPrix($products->getPrix());
        $product->setPicture($products->getPicture());
        $product->setQuantiter($products->getQuantiter());
        $product->setCreatedAt($products->getCreatedAt());

        $this->em->persist($product);
        $this->em->flush();
        return $product;
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
