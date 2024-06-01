<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Set;
use App\Entity\Word;
use Doctrine\ORM\EntityManagerInterface;

class SetController extends AbstractController
{
    #[Route('/api/sets/basic/{id}', name: 'api_sets_basic', methods: ['GET'])]
    public function getSet(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $set = $entityManager->getRepository(Set::class)->find($id);

        if (!$set) {
            return new JsonResponse(['error' => 'Set not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $responseData = [
            'set_name' => $set->getName(),
            'word_count' => $set->getWordCount(),
            'image' => $image ? [
                'id' => $image->getId(),
                'image_name' => $image->getImageName()
            ] : null,
            'words' => []
        ];

        foreach ($set->getWords() as $word) {
            $responseData['words'][] = [
                'word_id' => $word->getId(),
                'word_en' => $word->getWordEn(),
                'word_pl' => $word->getWordPl()
            ];
        }

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

}
