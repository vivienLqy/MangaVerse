<?php

namespace App\Controller;

use App\Entity\Oeuvre;
use App\Repository\OeuvreRepository;
use App\Service\OeuvreService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/oeuvres')]
class OeuvreController extends AbstractController
{

    private SerializerInterface $serializer;
    private OeuvreService $oeuvreService;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->oeuvreService = new OeuvreService($em);
        $this->serializer = $serializer;
    }


    #[Route('/', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN", message: "Vous n'avez pas les droits necessaire pour crée un livre")]
    public function create(#[MapRequestPayload()] Oeuvre $oeuvre): Response
    {
        return new Response($this->serializer->serialize($this->oeuvreService->create($oeuvre), 'json'));
    }

    #[Route('/', methods: ['GET'])]
    public function getAll(): Response
    {
        return new Response($this->serializer->serialize($this->oeuvreService->getAll(), 'json', ['groups' => 'getOeuvre']));
    }

    #[Route('/{id}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new Response($this->serializer->serialize($this->oeuvreService->get($id), 'json', ['groups' => 'getOeuvre']));
    }

    #[Route('/{id}', methods: ['PUT'])]
    // #[IsGranted("ROLE_ADMIN", message: "Vous n'avez pas les droits necessaire pour modifer un livre")]
    public function put(int $id, #[MapRequestPayload] Oeuvre $oeuvre): Response
    {
        $message = $this->oeuvreService->updateAll($id, $oeuvre);
        return new Response($message);
    }

    #[Route('/{id}', methods: ['PATCH'])]
    public function patch(int $id, #[MapRequestPayload] Oeuvre $oeuvre): Response
    {
        $message = $this->oeuvreService->update($id, $oeuvre);
        return new Response($message);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[IsGranted("ROLE_ADMIN", message: "Vous n'avez pas les droits necessaire pour supprimer un livre")]
    public function delete(Oeuvre $oeuvre): Response
    {
        try {
            $this->oeuvreService->delete($oeuvre);
            return new Response("L'élément avec le nom " . $oeuvre->getName() . " a été supprimé avec succès.", Response::HTTP_OK);
        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
