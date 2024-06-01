<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Set;
use App\Entity\Word;
use Doctrine\ORM\EntityManagerInterface;

class WordController extends AbstractController
{
    #[Route('/api/words/basic/add', name: 'api_words_create', methods: ['POST'])]
    public function createWord(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        $word_en = $request->request->get('word_en');
        $word_pl = $request->request->get('word_pl');
        $setId = $request->request->get('setId');

        $set = $entityManager->getRepository(Set::class)->find($setId);

        if (!$word_en || !$word_pl || !$set) {
            return new JsonResponse(['error' => 'Invalid request data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $word = new Word();
        $word->setWordEn($word_en)
            ->setWordPl($word_pl)
            ->addSet($set);

        $entityManager->persist($word);
        $entityManager->flush();

        return new JsonResponse(['id' => $word->getId()], JsonResponse::HTTP_CREATED);
    }


    #[Route('/api/words/set/{id}', name: 'api_words_in_set', methods: ['GET'])]
    public function getWordsInSet(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $set = $entityManager->getRepository(Set::class)->find($id);

        if (!$set) {
            return new JsonResponse(['error' => 'Set not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $responseData = [];

        foreach ($set->getWords() as $word) {
            $responseData[] = [
                'word_id' => $word->getId(),
                'word_en' => $word->getWordEn(),
                'word_pl' => $word->getWordPl()
            ];
        }

        shuffle($responseData);

        return new JsonResponse($responseData, JsonResponse::HTTP_CREATED);
    }
}
