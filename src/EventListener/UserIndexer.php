<?php

namespace App\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserIndexer
{
    public $token_storage;

    public function __construct(TokenStorageInterface $token_storage)
    {
        $this->token_storage = $token_storage;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // only act on some "BasePage" and "Organisation" entity
        if (!is_a($entity, "App\Entity\Page") and !is_a($entity, "App\Entity\Organisation")) {
            return;
        }

        $entity->setCreatedBy($this->token_storage->getToken()->getUsername());
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // only act on some "BasePage" and "Organisation" entity
        if (!is_a($entity, "App\Entity\Page") and !is_a($entity, "App\Entity\Organisation")) {
            return;
        }
        $entity->setModifiedBy($this->token_storage->getToken()->getUsername());
    }
}