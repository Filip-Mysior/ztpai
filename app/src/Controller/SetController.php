<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\Set;
use App\Entity\SetHistory;
use App\Entity\Word;
use App\Entity\User;
use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;

class SetController extends AbstractController
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/api/sets/basic/all', name: 'api_sets_all', methods: ['GET'])]
    public function getSets(EntityManagerInterface $entityManager): JsonResponse
    {
        $sets = $entityManager->getRepository(Set::class)->findAll();

        $responseData = [];

        foreach ($sets as $set) {
            $wordsData = [];
            $image = $set->getImage();

            foreach ($set->getWords() as $word) {
                $wordsData[] = [
                    'word_id' => $word->getId(),
                    'word_en' => $word->getWordEn(),
                    'word_pl' => $word->getWordPl()
                ];
            }

            $responseData[] = [
                'id' => $set->getId(),
                'set_name' => $set->getName(),
                'word_count' => $set->getWordCount(),
                'image' => $image ? $image->getId() : null,
                'words' => $wordsData
            ];
        }

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }


    #[Route('/api/sets/basic/{id}', name: 'api_sets_basic', methods: ['GET'])]
    public function getSet(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $set = $entityManager->getRepository(Set::class)->find($id);

        if (!$set) {
            return new JsonResponse(['error' => 'Set not found'], JsonResponse::HTTP_NOT_FOUND);
        }
        $currentUser  = $this->security->getUser();

        if ($currentUser) {
            $entityManager->getRepository(SetHistory::class)->updateSetHistory($set, $currentUser);
        }

        $image = $set->getImage();

        $responseData = [
            'set_name' => $set->getName(),
            'word_count' => $set->getWordCount(),
            'image' => $image ? $image->getId() : null,
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


    #[Route('/api/sets/basic/add', name: 'api_sets_create', methods: ['POST'])]
    public function createSet(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        $name = $request->request->get('setName');
        $imageId = $request->request->get('imageId');
        // $authorId = $requestData['author_id'] ?? null;
        $authorId = 1;
        $wordIds = [];

        $author = $entityManager->getRepository(User::class)->find($authorId);
        $image = $entityManager->getRepository(Image::class)->find($imageId);

        if (!$name || !$author || !$image) {
            return new JsonResponse(['error' => 'Invalid request data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $set = new Set();
        $set->setName($name)
            ->setAuthor($author)
            ->setImage($image);

        // Add words to the set
        foreach ($wordIds as $wordId) {
            $word = $entityManager->getRepository(Word::class)->find($wordId);
            if ($word) {
                $set->addWord($word);
            }
        }

        $entityManager->persist($set);
        $entityManager->flush();

        return new JsonResponse(['id' => $set->getId()], JsonResponse::HTTP_CREATED);
    }


    #[Route('/api/sets/search/name', name: 'api_sets_search', methods: ['GET'])]
    public function searchSetsByName(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $searchName = $request->query->get('name', '');

        $queryBuilder = $entityManager->getRepository(Set::class)->createQueryBuilder('s');

        if ($searchName !== '') {
            $queryBuilder->andWhere('LOWER(s.name) LIKE LOWER(:name)')
                         ->setParameter('name', '%' . strtolower($searchName) . '%');
        }

        $sets = $queryBuilder->getQuery()->getResult();

        $responseData = [];

        foreach ($sets as $set) {
            $wordsData = [];
            $image = $set->getImage();

            foreach ($set->getWords() as $word) {
                $wordsData[] = [
                    'word_id' => $word->getId(),
                    'word_en' => $word->getWordEn(),
                    'word_pl' => $word->getWordPl()
                ];
            }

            $responseData[] = [
                'id' => $set->getId(),
                'set_name' => $set->getName(),
                'word_count' => $set->getWordCount(),
                'image' => $image ? $image->getId() : null,
                'words' => $wordsData
            ];
        }

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }


    #[Route('/api/sets/history/get', name: 'api_sets_history', methods: ['GET'])]
    public function getSetHistory(EntityManagerInterface $entityManager): JsonResponse
    {
        $currentUser = $this->security->getUser();

        if (!$currentUser) {
            return new JsonResponse(['error' => 'User not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $setHistoryRecords = $entityManager->getRepository(SetHistory::class)->getUserSetHistory($currentUser);

        $responseData = [];

        foreach ($setHistoryRecords as $setHistory) {
            $set = $setHistory->getSet();
            $image = $set->getImage();

            $wordsData = [];
            foreach ($set->getWords() as $word) {
                $wordsData[] = [
                    'word_id' => $word->getId(),
                    'word_en' => $word->getWordEn(),
                    'word_pl' => $word->getWordPl()
                ];
            }

            $responseData[] = [
                'id' => $set->getId(),
                'set_name' => $set->getName(),
                'word_count' => $set->getWordCount(),
                'image' => $image ? $image->getId() : null,
                'words' => $wordsData,
                'last_accessed' => $setHistory->getTimestamp()->format('Y-m-d H:i:s')
            ];
        }

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }
}
