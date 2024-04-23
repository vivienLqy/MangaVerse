<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/api/users", methods: ['POST'])]
class UserController extends AbstractController
{
    private SerializerInterface $serializer;
    private UserService $userService;

    public function __construct(SerializerInterface $serializer, UserService $userService)
    {
        $this->serializer = $serializer;
        $this->userService = $userService;
    }

    #[Route("/", methods: ['POST'])]
    // #[IsGranted("ROLE_ADMIN", message: "Vous n'avez pas les droits necessaire pour crée un livre")]
    public function create(Request $request): Response
    {
        $userData = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        $createdUser = $this->userService->create($userData);
        return new Response($this->serializer->serialize($createdUser, 'json'));
    }

    #[Route('/', name: 'user_ok', methods: ['GET'])]
    public function getAll(): Response
    {
        return new Response($this->serializer->serialize($this->userService->getAll(), 'json'));
    }

    #[Route('/{id}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new Response($this->serializer->serialize($this->userService->get($id), 'json'));
    }
    #[Route('/{id}', methods: ['PUT'])]
    public function put(int $id, #[MapRequestPayload()] User $user): Response
    {
        $message = $this->userService->updateAll($id, $user);
        return new Response($message);
    }

    #[Route('/{id}', methods: ['PATCH'])]
    public function patch(int $id, #[MapRequestPayload] User $user): Response
    {
        $message = $this->userService->update($id, $user);
        return new Response($message);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits necessaire pour supprimer un livre")]
    public function delete(User $user): Response
    {
        try {
            $this->userService->delete($user);
            return new Response("Le compte avec l'email : " . $user->getEmail() . " a été supprimé avec succès.", Response::HTTP_OK);
        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
