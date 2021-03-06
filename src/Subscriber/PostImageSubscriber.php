<?php

namespace App\Subscriber;

use App\Entity\Organisation;
use App\Service\ImagesService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class PostImageSubscriber implements EventSubscriberInterface
{
    private $imagesService;

    public function __construct(ImagesService $imagesService)
    {
        $this->imagesService = $imagesService;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.pre_persist' => array('postImage'),
        );
    }

    function postImage(GenericEvent $event)
    {
//        $result = $event->getSubject();
//        $method = $event->getArgument('request')->getMethod();
//
//        if (!$result instanceof Organisation || $method !== Request::METHOD_POST) {
//            return;
//        }
//
//        if ($result->getLogo() instanceof UploadedFile) {
//            $url = $this->imagesService->saveToDisk($result->getLogo());
//            $result->setLogo($url);
//        }
    }
}