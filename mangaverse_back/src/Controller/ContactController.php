<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{

    #[Route("/create-contact", methods: ["POST"])]
    public function createContact(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $jsonData = $request->getContent();
        $contactDTO = $serializer->deserialize($jsonData, ContactDTO::class, 'json');

        // Validation de l'objet ContactDTO
        $errors = $validator->validate($contactDTO);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()][] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['message' => 'Contact created successfully'], Response::HTTP_OK);
    }
}
