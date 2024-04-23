<?php

namespace App\Service;

use App\Entity\Type;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class TypeService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Type $type)
    {
        $newCategorie = new Type();
        $newCategorie->setName($type->getName());

        $this->em->persist($newCategorie);
        $this->em->flush();
        return $newCategorie;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Type::class)->findAll();
    }

    public function get(int $id): Type
    {
        return $this->em->getRepository(Type::class)->find($id);
    }
    public function put(int $id, Type $type): string
    {
        $existingCategorie = $this->em->getRepository(Type::class)->find($id);
        if ($existingCategorie) {
            $existingCategorie
                ->setName($type->getName());

            $this->em->flush();
            return "Le produit avec l'ID {$id} a été mis a jour avec succès!";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas";
        }
    }

    public function delete(Type $type): void
    {
        try {
            $this->em->remove($type);
            $this->em->flush();
        } catch (Exception $e) {
            throw new Exception("Aucun élément avec l'id" . $type->getId() . "n'a été trouvé.");
        }
    }
}
