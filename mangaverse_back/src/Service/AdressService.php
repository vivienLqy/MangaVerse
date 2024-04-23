<?php

namespace App\Service;

use App\Entity\Adress;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class AdressService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(Adress $adress)
    {
        $adressPostal = new Adress();
        $adressPostal->setName($adress->getName());
        $adressPostal->setFname($adress->getFname());
        $adressPostal->setAdress($adress->getAdress());
        $adressPostal->setZipCode($adress->getZipCode());

        $this->em->persist($adressPostal);
        $this->em->flush();
        return $adressPostal;
    }
    public function getAll(): array
    {
        return $this->em->getRepository(Adress::class)->findAll();
    }
    public function get(int $id): Adress
    {
        return $this->em->getRepository(Adress::class)->find($id);
    }
    public function updateAll(int $id, Adress $adress): string
    {
        $existingAdress = $this->em->getRepository(Adress::class)->find($id);
        if ($existingAdress) {
            $existingAdress
                ->setName($adress->getName())
                ->setFname($adress->getFname())
                ->setAdress($adress->getAdress())
                ->setZipCode($adress->getZipCode());
            $this->em->flush();
            return "Le produit avec l'ID {$id} a été mis a jour avec succès!";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas";
        }
    }
    public function update(int $id, Adress $adress): string
    {
        $existingAdress = $this->em->getRepository(Adress::class)->find($id);

        if ($existingAdress) {
            $existingAdress->setName($adress->getName() ?? $existingAdress->getName());
            $existingAdress->setFname($adress->getFname() ?? $existingAdress->getFname());
            $existingAdress->setAdress($adress->getAdress() ?? $existingAdress->getAdress());
            $existingAdress->setZipCode($adress->getZipCode() ?? $existingAdress->getZipCode());

            $this->em->flush();

            return "L'adress avec l'ID {$id} a été mis à jour avec succès !";
        } else {
            return "L'adress avec l'ID {$id} n'existe pas";
        }
    }
    public function delete(int $id): string
    {
        $adress = $this->em->getRepository(Adress::class)->find($id);

        if ($adress) {
            $this->em->remove($adress);
            $this->em->flush();
            return "L'élément avec l'id $id a été supprimé avec succès.";
        } else {
            return "Aucun élément avec l'id $id n'a été trouvé.";
        }
    }
}
