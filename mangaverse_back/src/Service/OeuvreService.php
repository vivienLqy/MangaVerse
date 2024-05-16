<?php

namespace App\Service;

use App\Entity\Oeuvre;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class OeuvreService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Oeuvre $oeuvre)
    {
        $newOeuvre = new Oeuvre();
        $newOeuvre->setName($oeuvre->getName());
        $newOeuvre->setText($oeuvre->getText());
        $newOeuvre->setRating($oeuvre->getRating());
        $newOeuvre->setPegi($oeuvre->getPegi());
        $newOeuvre->setCreatedAt($oeuvre->getCreatedAt());
        $newOeuvre->setUpdateAt($oeuvre->getUpdateAt());

        $this->em->persist($newOeuvre);
        $this->em->flush();
        return $newOeuvre;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Oeuvre::class)->findAll();
    }

    public function get(int $id): Oeuvre
    {
        return $this->em->getRepository(Oeuvre::class)->find($id);
    }

    public function updateAll(int $id, Oeuvre $oeuvre): string
    {
        try {
            $existingOeuvre = $this->em->getRepository(Oeuvre::class)->find($id);
            if (!$existingOeuvre) {
                throw new Exception("Le produit avec l'ID {$id} n'existe pas.");
            }

            $existingOeuvre
                ->setName($oeuvre->getName())
                ->setText($oeuvre->getText())
                ->setRating($oeuvre->getRating())
                ->setPegi($oeuvre->getPegi())
                ->setCreatedAt($oeuvre->getCreatedAt());

            $this->em->flush();
            return "Le produit avec l'ID {$id} a été mis à jour avec succès!";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(int $id, Oeuvre $oeuvre): string
    {
        try {
            $existingOeuvre = $this->em->getRepository(Oeuvre::class)->find($id);
            if (!$existingOeuvre) {
                throw new Exception("Le produit avec l'ID {$id} n'existe pas.");
            }

            $existingOeuvre->setName($oeuvre->getName() ?? $existingOeuvre->getName());
            $existingOeuvre->setText($oeuvre->getText() ?? $existingOeuvre->getText());
            $existingOeuvre->setRating($oeuvre->getRating() ?? $existingOeuvre->getRating());
            $existingOeuvre->setPegi($oeuvre->getPegi() ?? $existingOeuvre->getPegi());
            $existingOeuvre->setCreatedAt($oeuvre->getCreatedAt() ?? $existingOeuvre->getCreatedAt());

            $this->em->flush();

            return "Le produit avec l'ID {$id} a été mis à jour avec succès !";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(Oeuvre $oeuvre): void
    {
        try {
            $this->em->remove($oeuvre);
            $this->em->flush();
        } catch (Exception $e) {
            throw new Exception("Aucun élément avec l'id " . $oeuvre->getId() . " n'a été trouvé.");
        }
    }
}
