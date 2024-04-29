<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Service\GenreService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GenreController extends AbstractController
{
    private SerializerInterface $serializer;
    private GenreService $genreService;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->genreService = new GenreService($em);
        $this->serializer = $serializer;
    }

    #[Route('/api/genres', methods: ['POST'])]
    public function create(#[MapRequestPayload()] Genre $genre): Response
    {
        return new Response($this->serializer->serialize($this->genreService->create($genre), 'json'));
    }

    #[Route('/api/genres', methods: ['GET'])]
    public function getAll(): Response
    {
        return new Response($this->serializer->serialize($this->genreService->getAll(), 'json', ['groups' => 'getGenre']));
    }

    #[Route('/api/genres/{id}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new Response($this->serializer->serialize($this->genreService->get($id), 'json', ['groups' => 'getGenre']));
    }

    #[Route('api/genres/{id}', methods: ['PUT'])]
    public function put(int $id, #[MapRequestPayload] Genre $genre): Response
    {
        $message = $this->genreService->put($id, $genre);
        return new Response($message);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Genre $genre): Response
    {
        try {
            $this->genreService->delete($genre);
            return new Response("L'élément avec le nom " . $genre->getName() . " a été supprimé avec succès.", Response::HTTP_OK);
        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
