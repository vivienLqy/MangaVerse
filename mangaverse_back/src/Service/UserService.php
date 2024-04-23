<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $hasher;
    
    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher)
    {
        $this->em = $em;
        $this->hasher = $hasher;
    }

    public function create(User $user)
    {
        $email = $user->getEmail();
        $password = $user->getPassword();

        $newUser = new User();
        $newUser->setEmail($email)
            ->setRoles([])
            ->setPassword($this->hasher->hashPassword($newUser, $password));

        $this->em->persist($newUser);
        $this->em->flush();
        
        return $newUser;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }
    public function get(int $id): User
    {
        return $this->em->getRepository(User::class)->find($id);
    }

    public function updateAll(int $id, User $user): string
    {
        $existingUser = $this->em->getRepository(User::class)->find($id);
        if ($existingUser) {
            $existingUser
                ->setEmail($user->getEmail())
                ->setRoles($user->getRoles())
                ->setPassword($user->getPassword());

            $this->em->flush();
            return "Le produit avec l'ID {$id} a été mis a jour avec succès!";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas";
        }
    }
    public function update(int $id, User $user): string
    {
        $existingUser = $this->em->getRepository(User::class)->find($id);

        if ($existingUser) {
            $existingUser->setEmail($user->getEmail() ?? $existingUser->getEmail());
            $existingUser->setRoles($user->getRoles() ?? $existingUser->getRoles());
            $password = $user->getPassword();
            $existingUser->setPassword($this->hasher->hashPassword($existingUser, $password));;


            $this->em->flush();

            return "Le produit avec l'ID {$id} a été mis à jour avec succès !";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas.";
        }
    }
    public function delete(User $user): void
    {
        try {
            $this->em->remove($user);
            $this->em->flush();
        } catch (Exception $e) {
            throw new Exception("Aucun élément avec l'id" . $user->getId() . "n'a été trouvé.");
        }
    }
}
