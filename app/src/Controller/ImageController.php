<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;

class ImageController extends AbstractController
{
    #[Route('/api/image', name: 'upload_image', methods: ['POST'])]
    public function uploadImage(Request $request, EntityManagerInterface $entityManager)
    {
        $imageFile = $request->files->get('image');

        if (!$imageFile) {
            return new Response('No image file provided', Response::HTTP_BAD_REQUEST);
        }

        $imageName = md5(uniqid()).'.'.$imageFile->guessExtension();

        $imageFile->move(
            $this->getParameter('images_directory'),
            $imageName
        );

        // Save the image details to the database
        $image = new Image();
        $image->setImageName($imageName);

        $entityManager->persist($image);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Image uploaded successfully', 'image_id' => $image->getId()], Response::HTTP_CREATED);
    }


    #[Route('/api/image/{id}', name: 'get_image', methods: ['GET'])]
    public function showImage(Image $image): Response
    {
        // Retrieve the image by ID or name
        $imagePath = $this->getParameter('images_directory').'/'.$image->getImageName();

        if (!file_exists($imagePath)) {
            return new Response('Image not found', Response::HTTP_NOT_FOUND);
        }

        // Return the image file as response
        return new Response(
            file_get_contents($imagePath),
            200,
            ['Content-Type' => mime_content_type($imagePath)] // Adjust content type based on your image type
        );
    }
}
