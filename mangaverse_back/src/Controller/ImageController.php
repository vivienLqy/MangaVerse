<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route("/upload-image", methods: ['POST'])]
    public function uploadImage(Request $request): Response
    {
        $base64Image = $request->request->get('image');
        $oeuvreName = $request->request->get('oeuvreName');
        // Validation du nom de l'oeuvre
        if (empty($oeuvreName)) {
            return new Response('Missing oeuvreName', Response::HTTP_BAD_REQUEST);
        }

        // Transformation du nom de l'oeuvre en format valide pour le répertoire
        $oeuvreDirectoryName = strtolower(str_replace(' ', '', $oeuvreName));

        if ($base64Image) {
            // Convertir la chaîne base64 en données binaires
            $imageData = base64_decode($base64Image);

            // Générer un nom de fichier unique
            $fileName = "$oeuvreDirectoryName" . uniqid() . '.png';

            // Chemin du répertoire de destination
            $destinationDirectory = $this->getParameter('kernel.project_dir') . '/public/img/manga/' .  $oeuvreDirectoryName;

            // Créer le répertoire s'il n'existe pas
            if (!file_exists($destinationDirectory)) {
                mkdir($destinationDirectory, 0777, true);
            }

            // Chemin complet du fichier de destination
            $destinationPath = $destinationDirectory . DIRECTORY_SEPARATOR . $fileName;

            // Enregistrer l'image dans le dossier public
            if (file_put_contents($destinationPath, $imageData)) {
                // Retourner une réponse avec le chemin de l'image enregistrée
                return new Response($fileName, Response::HTTP_CREATED);
            } else {
                // Gérer l'échec de l'enregistrement du fichier
                return new Response('Erreur lors de l\'enregistrement de l\'image', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            // Retourner une réponse avec un message d'erreur si aucune image n'est fournie
            return new Response('Aucune image fournie', Response::HTTP_BAD_REQUEST);
        }
    }
    #[Route('/api/img/manga/{path}', methods: ['GET'])]
    public function getImage(string $path): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/img/manga/';

        // Utilisation de preg_split avec une expression régulière
        $parts = preg_split('/\d/', $path, 2);
        $filePath .= $parts[0] . '/' . $path;

        // Vérifier si le fichier existe
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return new Response('Fichier non trouvé', 404);
        }

        // Récupérer le type MIME de l'image
        $mimeType = mime_content_type($filePath);

        // Lire le contenu du fichier
        $content = file_get_contents($filePath);

        // Créer une réponse avec le contenu et le type MIME
        $response = new Response($content);
        $response->headers->set('Content-Type', $mimeType);

        return $response;
    }
}
