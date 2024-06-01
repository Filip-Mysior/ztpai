<?php

namespace App\EventListener;

use Doctrine\ORM\Event\PreRemoveEventArgs;
use App\Entity\Word;

class WordDeletionListener
{
    public function preRemove(PreRemoveEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Word) {
            $sets = $entity->getSets();

            foreach ($sets as $set) {
                $set->removeWord($entity);
            }
        }
    }
}
