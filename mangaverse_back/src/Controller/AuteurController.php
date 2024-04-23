<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Service\AuteurService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AuteurController extends AbstractController
{
    private SerializerInterface $serializer;
    private AuteurService $auteurService;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->auteurService = new AuteurService($em);
        $this->serializer = $serializer;
    }

    #[Route('/api/auteurs', methods: ['POST'])]
    public function create(#[MapRequestPayload()] Auteur $auteur): Response
    {
        return new Response($this->serializer->serialize($this->auteurService->create($auteur), 'json'));
    }

    #[Route('/api/auteurs', methods: ['GET'])]
    public function getAll(): Response
    {
        return new Response($this->serializer->serialize($this->auteurService->getAll(), 'json'));
    }

    #[Route('/api/auteurs/{id}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new Response($this->serializer->serialize($this->auteurService->get($id), 'json'));
    }

    #[Route('api/auteurs/{id}', methods: ['PUT'])]
    public function put(int $id, #[MapRequestPayload] Auteur $auteur): Response
    {
        $message = $this->auteurService->put($id, $auteur);
        return new Response($message);
    }

    #[Route('/api/auteurs/{id}', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $message = $this->auteurService->deleteById($id);
        return new Response($message);
    }
}


