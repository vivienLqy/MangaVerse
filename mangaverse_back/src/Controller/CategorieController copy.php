<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Service\CategorieService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CategorieController extends AbstractController
{
    private SerializerInterface $serializer;
    private CategorieService $categorieService;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->categorieService = new CategorieService($em);
        $this->serializer = $serializer;
    }

    #[Route('/api/categorie', methods: ['POST'])]
    public function create(#[MapRequestPayload()] Categorie $categorie): Response
    {
        return new Response($this->serializer->serialize($this->categorieService->create($categorie), 'json'));
    }

    #[Route('/api/categorie', methods: ['GET'])]
    public function getAll(): Response
    {
        return new Response($this->serializer->serialize($this->categorieService->getAll(), 'json', ['groups' => 'getCategorie']));
    }

    #[Route('/api/categorie/{id}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new Response($this->serializer->serialize($this->categorieService->get($id), 'json', ['groups' => 'getCategorie']));
    }

    #[Route('api/categorie/{id}', methods: ['PUT'])]
    public function put(int $id, #[MapRequestPayload] Categorie $categorie): Response
    {
        $message = $this->categorieService->put($id, $categorie);
        return new Response($message);
    }

    #[Route('/api/products/{id}', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $message = $this->categorieService->deleteById($id);
        return new Response($message);
    }
}
