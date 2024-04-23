<?php

namespace App\Service;

use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;

class AuteurService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Auteur $categorie)
    {
        $newAuteur = new Auteur();
        $newAuteur->setName($categorie->getName());

        $this->em->persist($newAuteur);
        $this->em->flush();
        return $newAuteur;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Auteur::class)->findAll();
    }

    public function get(int $id): Auteur
    {
        return $this->em->getRepository(Auteur::class)->find($id);
    }
    public function put(int $id, Auteur $auteur): string
    {
        $existingAuteur = $this->em->getRepository(Auteur::class)->find($id);
        if ($existingAuteur) {
            $existingAuteur
                ->setName($auteur->getName());

            $this->em->flush();
            return "Le produit avec l'ID {$id} a été mis a jour avec succès!";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas";
        }
    }

    public function deleteById(int $id): string
    {
        $products = $this->em->getRepository(Auteur::class)->find($id);

        if ($products) {
            $this->em->remove($products);
            $this->em->flush();
            return "L'élément avec l'id $id a été supprimé avec succès.";
        } else {
            return "Aucun élément avec l'id $id n'a été trouvé.";
        }
    }
}
