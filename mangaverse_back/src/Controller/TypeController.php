<?php

namespace App\Controller;

use App\Entity\Type;
use App\Service\TypeService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TypeController extends AbstractController
{
    private SerializerInterface $serializer;
    private TypeService $typeService;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->typeService = new TypeService($em);
        $this->serializer = $serializer;
    }

    #[Route('/api/type', methods: ['POST'])]
    public function create(#[MapRequestPayload()] Type $type): Response
    {
        return new Response($this->serializer->serialize($this->typeService->create($type), 'json'));
    }

    #[Route('/api/type', methods: ['GET'])]
    public function getAll(): Response
    {
        return new Response($this->serializer->serialize($this->typeService->getAll(), 'json', ['groups' => 'getType']));
    }

    #[Route('/api/type/{id}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new Response($this->serializer->serialize($this->typeService->get($id), 'json', ['groups' => 'getType']));
    }

    #[Route('api/type/{id}', methods: ['PUT'])]
    public function put(int $id, #[MapRequestPayload] Type $type): Response
    {
        $message = $this->typeService->put($id, $type);
        return new Response($message);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Type $type): Response
    {
        try {
            $this->typeService->delete($type);
            return new Response("L'élément avec le nom " . $type->getName() . " a été supprimé avec succès.", Response::HTTP_OK);
        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
