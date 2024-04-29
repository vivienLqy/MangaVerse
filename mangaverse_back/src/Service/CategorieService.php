<?php

namespace App\Service;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;

class CategorieService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Categorie $categorie)
    {
        $newCategorie = new Categorie();
        $newCategorie->setName($categorie->getName());

        $this->em->persist($newCategorie);
        $this->em->flush();
        return $newCategorie;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Categorie::class)->findAll();
    }

    public function get(int $id): Categorie
    {
        return $this->em->getRepository(Categorie::class)->find($id);
    }
    public function put(int $id, Categorie $categorie): string
    {
        $existingCategorie = $this->em->getRepository(Categorie::class)->find($id);
        if ($existingCategorie) {
            $existingCategorie
                ->setName($categorie->getName());

            $this->em->flush();
            return "Le produit avec l'ID {$id} a été mis a jour avec succès!";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas";
        }
    }

    public function deleteById(int $id): string
    {
        $existingCategorie = $this->em->getRepository(Categorie::class)->find($id);

        if ($existingCategorie) {
            $this->em->remove($existingCategorie);
            $this->em->flush();
            return "L'élément avec l'id $id a été supprimé avec succès.";
        } else {
            return "Aucun élément avec l'id $id n'a été trouvé.";
        }
    }
}
