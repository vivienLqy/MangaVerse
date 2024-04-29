<?php

namespace App\Service;

use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class GenreService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Genre $genre)
    {
        $newGenre = new Genre();
        $newGenre->setName($genre->getName());

        $this->em->persist($newGenre);
        $this->em->flush();
        return $newGenre;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Genre::class)->findAll();
    }

    public function get(int $id): Genre
    {
        return $this->em->getRepository(Genre::class)->find($id);
    }
    public function put(int $id, Genre $genre): string
    {
        $existingGenre = $this->em->getRepository(Genre::class)->find($id);
        if ($existingGenre) {
            $existingGenre
                ->setName($genre->getName());

            $this->em->flush();
            return "Le produit avec l'ID {$id} a été mis a jour avec succès!";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas";
        }
    }

    public function delete(Genre $genre): void
    {
        try {
            $this->em->remove($genre);
            $this->em->flush();
        } catch (Exception $e) {
            throw new Exception("Aucun élément avec l'id" . $genre->getId() . "n'a été trouvé.");
        }
    }
}
