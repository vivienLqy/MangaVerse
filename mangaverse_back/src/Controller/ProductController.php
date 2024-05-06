<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends AbstractController
{

    private SerializerInterface $serializer;
    private ProductService $productsService;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->productsService = new ProductService($em);
        $this->serializer = $serializer;
    }

    #[Route('/api/products', methods: ['POST'])]
    // #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits necessaire pour creer un livre")]
    public function create(#[MapRequestPayload()] Product $Product): Response
    {
        return new Response($this->serializer->serialize($this->productsService->create($Product), 'json', ['groups' => 'getProduct']));
    }
    #[Route('api/products', methods: ['GET'])]
    public function getAll(): Response
    {
        return new Response($this->serializer->serialize($this->productsService->getAll(), 'json', ['groups' => 'getProduct']));
    }

    #[Route('api/products/{id}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new Response($this->serializer->serialize($this->productsService->get($id), 'json', ['groups' => 'getProduct']));
    }

    #[Route('api/products/{id}', methods: ['PUT'])]
    #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits necessaire pour modifer un livre")]
    public function put(int $id, #[MapRequestPayload] Product $product): Response
    {
        $message = $this->productsService->updateAll($id, $product);
        return new Response($message);
    }

    #[Route('api/products/{id}', methods: ['PATCH'])]
    // #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits necessaire pour modifer un livre")]
    public function patch(int $id, #[MapRequestPayload] Product $product): Response
    {
        $message = $this->productsService->update($id, $product);
        return new Response($message);
    }

    #[Route('/api/products/{id}', methods: ['DELETE'])]
    // #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits necessaire pour supprimer un livre")]
    public function delete(int $id): Response
    {
        $message = $this->productsService->delete($id);
        return new Response($message);
    }
}
