<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    #[Route("/upload-image", methods: ['POST'])]
    public function uploadImage(Request $request): Response
    {
        $base64Image = $request->request->get('image');
        $oeuvreName = $request->request->get('oeuvreName');
        $productPrice = $request->request->get('oeuvreName');

        if (!$base64Image || !$oeuvreName) {
            return new Response('Missing image or oeuvreName', Response::HTTP_BAD_REQUEST);
        }

        $oeuvreName = strtolower(str_replace(' ', '', $oeuvreName));

        $destination = $this->getParameter('images_directory') . DIRECTORY_SEPARATOR . $oeuvreName;

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        try {
            $imageData = base64_decode($base64Image, true);

            if ($imageData === false) {
                return new Response('Failed to decode base64Image', Response::HTTP_BAD_REQUEST);
            }

            $uniqueFileName = $oeuvreName . '_' . uniqid() . '.png';

            file_put_contents($destination . DIRECTORY_SEPARATOR . $uniqueFileName, $imageData);

            $imagePath = $destination . DIRECTORY_SEPARATOR . $uniqueFileName;
            $imageProduct = new Product();
            $imageProduct->setName($oeuvreName);
            $imageProduct->setPicture($imagePath);
            $this->productService->create($imageProduct);

            return new Response('Image uploaded and product created successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response('Failed to upload image', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
